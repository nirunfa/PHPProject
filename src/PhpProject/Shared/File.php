<?php
/**
 * This file is part of PHPProject - A pure PHP library for reading and writing
* presentations documents.
*
* PHPProject is free software distributed under the terms of the GNU Lesser
* General Public License version 3 as published by the Free Software Foundation.
*
* For the full copyright and license information, please read the LICENSE
* file that was distributed with this source code. For the full list of
* contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
*
* @link        https://github.com/PHPOffice/PHPProject
* @copyright   2009-2014 PHPProject contributors
* @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
*/

namespace PhpOffice\PhpProject\Shared;

/**
 * PHPProject_Shared_File
 *
 * @category   PHPProject
 * @package    PHPProject_Shared
 * @copyright  Copyright (c) 2012 - 2012 PHPProject (https://github.com/PHPOffice/PHPProject)
 */
class File
{
    /**
     * Get the systems temporary directory.
     *
     * @return string
     */
    public static function sysGetTempDir()
    {
        // sys_get_temp_dir is only available since PHP 5.2.1
        // http://php.net/manual/en/function.sys-get-temp-dir.php#94119

        if (!function_exists('sys_get_temp_dir')) {
            if ($temp = getenv('TMP')) {
                if ((!empty($temp)) && (file_exists($temp))) {
                    return realpath($temp);
                }
            }
            if ($temp = getenv('TEMP')) {
                if ((!empty($temp)) && (file_exists($temp))) {
                    return realpath($temp);
                }
            }
            if ($temp = getenv('TMPDIR')) {
                if ((!empty($temp)) && (file_exists($temp))) {
                    return realpath($temp);
                }
            }

            // trick for creating a file in system's temporary dir
            // without knowing the path of the system's temporary dir
            $temp = tempnam(__FILE__, '');
            if (file_exists($temp)) {
                unlink($temp);
                return realpath(dirname($temp));
            }

            return null;
        }

        // use ordinary built-in PHP function
        //    There should be no problem with the 5.2.4 Suhosin realpath() bug, because this line should only
        //        be called if we're running 5.2.1 or earlier
        return realpath(sys_get_temp_dir());
    }
}
