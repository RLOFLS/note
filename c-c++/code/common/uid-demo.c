#include <stdio.h>
#include <unistd.h>
#include <sys/types.h>

int main()
{
    uid_t uid = getuid();
    uid_t euid = geteuid();
    printf("userId is %d, effective userid is %d \n", uid, euid);
    return 0;
}