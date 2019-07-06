<?php

function trim_all(&$value)
{ 
	  if (is_array($value))
	  {   
		array_walk_recursive($value, 'trim_all');
	  }
	  else
	  {   
		$value = trim(str_replace("\r\n", "\n", $value));
	  }
}

/**
  *  Return Type : ARRAY 
  */
function dateDifference($startDate, $endDate)
        {
            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);
            if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate)
                return false;
               
            $years = date('Y', $endDate) - date('Y', $startDate);
           
            $endMonth = date('m', $endDate);
            $startMonth = date('m', $startDate);
           
            // Calculate months
            $months = $endMonth - $startMonth;
            if ($months <= 0)  {
                $months += 12;
                $years--;
            }
            if ($years < 0)
                return false;
           
            // Calculate the days
                        $offsets = array();
                        if ($years > 0)
                            $offsets[] = $years . (($years == 1) ? ' year' : ' years');
                        if ($months > 0)
                            $offsets[] = $months . (($months == 1) ? ' month' : ' months');
                        $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now';

                        $days = $endDate - strtotime($offsets, $startDate);
                        $days = date('z', $days);   
                       
            return array($years, $months, $days);
        } 


function getCurrentOS()
{
	  $OSList = array(
		    'Windows 3.11' => 'Win16',
		    'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
		    'Windows 98' => '(Windows 98)|(Win98)',
		    'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
		    'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
		    'Windows Server 2003' => '(Windows NT 5.2)',
		    'Windows Vista' => '(Windows NT 6.0)',
		    'Windows 7' => '(Windows NT 7.0)',
		    'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
		    'Windows ME' => 'Windows ME',
		    'Open BSD' => 'OpenBSD',
		    'Sun OS' => 'SunOS',
		    'Linux' => '(Linux)|(X11)',
		    'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
		    'QNX' => 'QNX', 
		    'BeOS' => 'BeOS',
		    'OS/2' => 'OS/2',
		    'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
	  );

      foreach($OSList as $CurrOS=>$Match){
              if (preg_match('/'.$Match.'/i', $_SERVER['HTTP_USER_AGENT'])){
                      break;
              }
      }
      return $CurrOS;
}





?>