#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<errno.h>
#include<sys/types.h>
#include<sys/socket.h>
#include<netinet/in.h>

#define MAXLINE 4096

int main(int argc, char** argc)
{
	int listenfd, connfd;
	struct sockaddr_in  servaddr;
	char buff[4096];
	int n;

	if((listenfd = socket(AF_INET, SOCK_STREAM, 0)) ==-1)//建立socket并判断是否建立成功 
	{                                                    //三个参数分别是通信区域、套接字类型、套接字协议
		printf("create socket error: %s(errno: %d)/n",strerror(errno),errno);
		exit(0);
	}

	memset(&servaddr, 0, sizeof(servaddr));	//将servaddr的所有位清空 //绑定给sockefd的协议地址，根据地址协议族不同而不同，以下三项是ipv4的
	servaddr.sin_family = AF_INET;         				//address family: AF_INET
	servaddr.sin_addr.s_addr = htonl(INADDR_ANY); 	    //port in network byte order
	servaddr.sin_port = htons(6666);        			//internet address

	if(bind(listenfd, (struct sockaddr*)&servaddr, sizeof(servaddr)) == -1)
	{
		printf("bind socket error: %s(errno: %d/n",strerror(errno),errno);
			exit(0);
	}

	if(listen(listenfd, 10) == -1)
	{
		printf("listen socket error:%s(sror:%d)/n",strerror(errno),errno);
		exit(0);
	}

	printf("======waiting for client's request========/n");
	while(1){
		if((connfd = accept(listenfd, (struct sockaddr*)NULL,NULL)) == -1){
			printf("accept socket error: %s(errno: %d)",strerror(errno),errno);
			continue;
		}
	n = recv(connfd, buff, MAXLINE, 0);
	buff[n] = '/0';
	printf("recv msg from client: %s/n",buff);
	close(connfd);
	}

	close(listenfd);

}