<?php
/******************
* SUBSTRING USAGE *
******************/


$rest = substr("abcdef", -1);    // returns "f"
$rest = substr("abcdef", -2);    // returns "ef"
$rest = substr("abcdef", -3, 1); // returns "d"
$rest = substr("abcdef", 0, -1);  // returns "abcde"
$rest = substr("abcdef", 2, -1);  // returns "cde"
$rest = substr("abcdef", 4, -4);  // returns ""; prior to PHP 8.0.0, false was returned
$rest = substr("abcdef", -3, -1); // returns "de"

echo substr('abcdef', 1);     // bcdef
echo substr("abcdef", 1, null); // bcdef; prior to PHP 8.0.0, empty string was returned
echo substr('abcdef', 1, 3);  // bcd
echo substr('abcdef', 0, 4);  // abcd
echo substr('abcdef', 0, 8);  // abcdef
echo substr('abcdef', -1, 1); // f

// Accessing single characters in a string
// can also be achieved using "square brackets"
$string = 'abcdef';
echo $string[0];                 // a
echo $string[3];                 // d
echo $string[strlen($string)-1]; // f
?>

<?php
class apple {
    public function __toString() {
        return "green";
    }
}

echo "1) ".var_export(substr("pear", 0, 2), true).PHP_EOL;
echo "2) ".var_export(substr(54321, 0, 2), true).PHP_EOL;
echo "3) ".var_export(substr(new apple(), 0, 2), true).PHP_EOL;
echo "4) ".var_export(substr(true, 0, 1), true).PHP_EOL;
echo "5) ".var_export(substr(false, 0, 1), true).PHP_EOL;
echo "6) ".var_export(substr("", 0, 1), true).PHP_EOL;
echo "7) ".var_export(substr(1.2e3, 0, 4), true).PHP_EOL;

/* the above function outputs the following:
1) 'pe'
2) '54'
3) 'gr'
4) '1'
5) ''
6) ''
7) '1200'
*/ ?>

<?php
/**************
* DATES USAGE *
**************/
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l");


// escaping characters
echo date('l \t\h\e jS'); // prints something like: Wednesday the 15th

// automatic copyright date
// &copy; 2010-<?php echo date("Y");

// Here are some characters that are commonly used for times:
    // H - 24-hour format of an hour (00 to 23)
    // h - 12-hour format of an hour with leading zeros (01 to 12)
    // i - Minutes with leading zeros (00 to 59)
    // s - Seconds with leading zeros (00 to 59)
    // a - Lowercase Ante meridiem and Post meridiem (am or pm)
echo "The time is " . date("h:i:sa");

date_default_timezone_set("America/New_York");
echo "The time is " . date("h:i:sa");

// mktime(hour, minute, second, month, day, year)
$d=mktime(11, 14, 54, 8, 12, 2014);
echo "Created date is " . date("Y-m-d h:i:sa", $d);

// strtotime(time, now)
$d=strtotime("10:30pm April 15 2014");
echo "Created date is " . date("Y-m-d h:i:sa", $d);

$d=strtotime("tomorrow");
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d=strtotime("next Saturday");
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d=strtotime("+3 Months");
echo date("Y-m-d h:i:sa", $d) . "<br>";

// output dates for the next six saturdays
$startdate = strtotime("Saturday");
$enddate = strtotime("+6 weeks", $startdate);
while ($startdate < $enddate) {
  echo date("M d", $startdate) . "<br>";
  $startdate = strtotime("+1 week", $startdate);
}

// output days until July 4
$d1=strtotime("July 04");
$d2=ceil(($d1-time())/60/60/24);
echo "There are " . $d2 ." days until 4th of July.";

// FULL DATES REFERENCE:
// https://www.w3schools.com/php/php_ref_date.asp

