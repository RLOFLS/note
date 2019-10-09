#include <stdio.h>
void byteorder();
int main()
{
    byteorder();
    return 0;
}
//判断计算机系统是大端字节还是小端字节
void byteorder() {
    union 
    {
        short value;
        char union_bytes[sizeof( short)];
    } test;
    test.value = 0x0102;

    for(int i = 0; i<sizeof(short);i++) {
        printf("%p ---- %d ",&(test.union_bytes[i]),test.union_bytes[i]);
    }
    putchar('\n');

    if( ( test.union_bytes[0] == 1) && (test.union_bytes[1] == 2)) {
        printf("big endian\n");
    } else if ( ( test.union_bytes[0] == 2) && (test.union_bytes[1] ==1 )) {
        printf("little endian\n");
    } else {
        printf("unknow ... \n");
    }
    
}