<?php                    $database = 'test';
                    $user = 'root';
                    $pass = '';
                    $host = 'localhost:3308';
                    $charset = "utf8mb4"; # utf8mb4_unicode_ci 

                    $conn = new mysqli($host, $user, $pass, $database);
                    $conn->set_charset($charset);

                    # get all tables
                    $result = mysqli_query($conn, "SHOW TABLES");
                    $tables = array();

                    while ($row = mysqli_fetch_row($result)) {
                        $tables[] = $row[0];
                    }

                    # Get tables data 
                    $sqlScript = "";
                    foreach ($tables as $table) {
                        $query = "SHOW CREATE TABLE $table";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_row($result);
                        
                        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
                        
                        
                        $query = "SELECT * FROM $table";
                        $result = mysqli_query($conn, $query);
                        
                        $columnCount = mysqli_num_fields($result);
                        
                        for ($i = 0; $i < $columnCount; $i ++) {
                            while ($row = mysqli_fetch_row($result)) {
                                $sqlScript .= "INSERT INTO $table VALUES(";
                                for ($j = 0; $j < $columnCount; $j ++) {
                                    $row[$j] = $row[$j];
                                    
                                    $sqlScript .= (isset($row[$j])) ? '"' . $row[$j] . '"' : '""';

                                    if ($j < ($columnCount - 1)) {
                                        $sqlScript .= ',';
                                    }

                                }
                                $sqlScript .= ");\n";
                            }
                        }
                        
                        $sqlScript .= "\n"; 
                    }
                    $backupFileName = $database . '_backup_' . time() . '.sql';

                    //save file
                    $mysql_file = fopen($database . '_backup_'.time() . '.sql', 'w+');
                    fwrite($mysql_file ,$sqlScript );
                    fclose($mysql_file );

                    // Descarga del archivo
                    header('Content-Type: application/sql');
                    header('Content-Description: File Transfer');

                    header('Content-Disposition: attachment; filename=' . basename($backupFileName));
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($backupFileName));
                    ob_clean();
                    flush();
                    readfile($backupFileName);

                    // Eliminar el archivo después de descargarlo si se desea
                    unlink($backupFileName);
                    ?>