class Dbg {

    protected static $timers = [];

    public static function timer($string)
    {
        self::$timers[] = [
            'name' => $string,
            'time' => microtime(true),
        ];
    }

    public static function log($return = false)
    {
        self::timer('');

        $args = [];
        $format = "\n";

        for ($i = 0; $i < (count(self::$timers) - 1); $i++) {
            $dtime = self::$timers[$i + 1]['time'] - self::$timers[$i]['time'];
            $form = '%01.3f - ' . self::$timers[$i]['name'];
            $args[] = sprintf($form, $dtime);
        }

        $str = $format . implode($format, $args);

        if ($return) {
            return $str;
        }

        error_log($str);
    }
}
