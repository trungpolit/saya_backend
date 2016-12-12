PID_FILE=$0.pid
APP_PATH=/home/famcd044/public_html/cms.famion.vn/app
FILE_NAME=$(basename $0)
FILE_NAME="${FILE_NAME%.*}"
[ -f $PID_FILE ] && {
   pid=`cat $PID_FILE`
   ps -p $pid && {
    echo -e "$FILE_NAME is running ..." >> $APP_PATH/tmp/logs/$FILE_NAME.out.log
    exit
   }
   rm -f $PID_FILE
}
echo $$ > $PID_FILE
php $APP_PATH/cron_dispatcher.php /CrontabDailyReports/index >> $APP_PATH/tmp/logs/$FILE_NAME.out.log 2>&1