#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <assert.h>
#include <stdio.h>
#include <unistd.h>
#include <string.h>
#include <stdlib.h>
#include <libgen.h>
#include <errno.h>

#define BUF_SIZE 1024

int main( int argc, char* argv[]) {
    if (argc < 2) {
        printf("usage: %s ip_address port \n", basename(argv[0]) );
        return 1;
    }

    const char* ip = argv[1];
    int port = atoi(argv[2]);

    struct sockaddr_in address;
    bzero(&address, sizeof(address));
    address.sin_family = AF_INET;
    inet_pton(AF_INET, ip, &address.sin_addr);
    address.sin_port = htons(port);

    int sock = socket(PF_INET, SOCK_STREAM, 0);
    assert(sock >=0);

    int ret = bind(sock, (struct sockaddr*)&address, sizeof(address));
    assert(ret != -1);

    ret = listen(sock, 5);
    assert(ret != -1);

    struct sockaddr_in client;
    socklen_t client_addresslength = sizeof( client);
    int connfd = accept(sock, (struct sockaddr*)&client, &client_addresslength);
    if (connfd < 0) {
        printf( "errno is %d\n", errno);
    } else {
        char buffer[BUF_SIZE];

        memset(buffer, '\0', BUF_SIZE);
        ret = recv(connfd, buffer, BUF_SIZE - 1, 0);
        printf("got %d btyes of normal data '%s' \n", ret, buffer);

        memset(buffer, '\0', BUF_SIZE);
        ret = recv(connfd, buffer, BUF_SIZE-1, MSG_OOB);
        printf("got %d bytes of oob data '%s' \n", ret, buffer);

        memset(buffer, '\0', BUF_SIZE);
        ret = recv(connfd, buffer, BUF_SIZE - 1, 0);
        printf("got %d btyes of normal data '%s' \n", ret, buffer);

        close(connfd);
    }

    close(sock);
    return 0;
}