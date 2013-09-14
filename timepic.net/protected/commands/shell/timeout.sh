#!/bin/sh
if [ $# -lt 2 ]; then
cat<<HELP
     help -- control command runs time.when timeout the command will be kill

     USAGE: timeout 'time' 'command'
     EXAMPLE: rename 30 '/usr/local/bin/php test.php':
HELP
     exit 0
fi
 
waitfor="$1"
command="$2"
timeout()
{
        $command > /tmp/ieltseye.log 2>&1 &
        commandpid=$!
        ( sleep $waitfor ; kill -9 $commandpid > /dev/null 2>&1 ) &
        watchdog=$!
        sleeppid=$PPID
        #原文中这句应该是有误，为什么要这么获取父进程ID？
        #sleeppid=`ps $ppid $watchdog |  awk '{print $1}'`
        #下面一行加上重定向是避免在被KILL的时候，报出被kill的提示
        #当然带来的副作用是重定向不一定符合预期
        wait $commandpid > /dev/null 2>&1 
 
        kill $sleeppid > /dev/null 2>&1
}
timeout
