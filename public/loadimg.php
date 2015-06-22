<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 1/29/15
 * Time: 4:22 PM
 */

                                                            //Open images directory
                                                            $dir = opendir("./uploads/images/");

                                                            //List files in images directoryb
                                                            while (($file = readdir($dir)) !== false) {
                                                                if(substr( $file, -3 ) == "jpg" || substr( $file, -3 ) == "png" || substr( $file, -3 ) == "JPG" ) {
                                                                    $filelist[] = $file;

                                                                }
                                                            }


                                                            closedir($dir);
                                                            sort($filelist);
                                                    echo "<ul class='imglist'>";
                                                            for($i=0; $i<count($filelist); $i++) {
                                                                echo "

                                                                    <li><label><input class='form-control radio radimg' type='radio' id='input$i' name='inpute' value='$filelist[$i]'><img
                                                                         src='".ASSETS_URL."/uploads/images/".$filelist[$i] ."' width='100' height='100'></label></li>

                                                            ";
                                                            }
                                                        echo "</ul>";
?>