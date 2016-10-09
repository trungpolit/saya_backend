PID_FILE=$0.pid
PATH=/home/u289389444/public_html/cms/app
FILE_NAME=$(basename $0)
FILE_NAME="${FILE_NAME%.*}"
[ -f $PID_FILE ] && {
   pid=`cat $PID_FILE`
   ps -p $pid && {
    echo -e "$FILE_NAME is running ..." >> $PATH/tmp/logs/$FILE_NAME.out.log
    exit
   }
   rm -f $PID_FILE
}
echo $$ > $PID_FILE
php $PATH/cron_dispatcher.php /CrontabOrdersDistributors/send >> $PATH/tmp/logs/$FILE_NAME.out.log 2>&1