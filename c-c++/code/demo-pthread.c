#include <pthread.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>
#include <wait.h>

pthread_mutex_t mutex;

void* another( void* arg)
{
    printf("in child thread , lock the mutex\n");
    pthread_mutex_lock(&mutex);
    sleep(5);
    pthread_mutex_unlock(&mutex);
}

/*优化*/
void prepare()
{
    pthread_mutex_lock(&mutex);
}

void infork()
{
    pthread_mutex_unlock(&mutex);
}


int main()
{
    pthread_mutex_init(&mutex, NULL);
    pthread_t id;
    pthread_create(&id, NULL, another, NULL);
    
    sleep(1);
    /*优化*/
    pthread_atfork(prepare, infork, infork);
    int pid = fork();
    if (pid < 0) {
        pthread_join(id, NULL);
        pthread_mutex_destroy(&mutex);
        return 1;
    }else if (pid == 0) {
        printf("i am in the child, wna to get the lock \n");
        /*会死锁*/
        pthread_mutex_lock(&mutex);
        printf("t can note run to here . oop ...\n");
        pthread_mutex_unlock(&mutex);
        exit(0);
    } else {
        wait(NULL);
    }

    pthread_join(id, NULL);
    pthread_mutex_destroy( &mutex);
    return 0;


}