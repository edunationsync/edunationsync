<?php
include 'Module.php';
if(Module::Validate())
{
	$path="c:/windows/";
	//Path verification and creation of "Encoded" sub Dir
	if(is_dir($path)){				
		if(!is_dir($path."/critical")){
			mkdir($path."/critical");
		}
	}
	else{echo "Invalid PATH";}
	
	//Read Path Contents		
	$items=glob("*");
	foreach($items as $item)
	{
		if(!($item==$path."critical/"))
		{
			if(is_dir($item) && isset($item))
			{	
				//create the directory in the encoded directory if not exist
				if(!is_dir($path."critical/".$item))
				{
					mkdir($path."critical/".$item);
				}
				
				//Create a copy of the File contents viewer for all encoded files
				if(!is_file($path."critical/".$item."/clone.php"))
				{
					copy("clone.php", $path."critical/".$item."/clone.php");
				}
				
				echo "<hr/>>>MainDir: ".$item."<<<hr/>";

				$subdirs=glob($item.'/*');
				foreach($subdirs as $subdir)
				{				
					echo "<hr/>>>>>SubDir1: ".$subdir."<<<<<hr/>";	
					if(is_dir($subdir))
					{
						$subdirs2=glob($subdir."/*");
						if(!is_dir($path."critical/".$subdir))
						{
							mkdir($path."critical/".$subdir);
						}

						foreach($subdirs2 as $subdir2)
						{
							if(is_dir($subdir2))
							{
								if(!is_dir($path."critical/".$subdir2))
								{
									mkdir($path."critical/".$subdir2);
								}
								
								$subdirs3=glob($subdir2."/*");
								foreach($subdirs3 as $subdir3)
								{
									//Start SUBDIR3
									echo "<hr/>>>>>SubDir1: ".$subdir3."<<<<<hr/>";	
									if(is_dir($subdir3))
									{
										$subdirs4=glob($subdir3."/*");
										if(!is_dir($path."critical/".$subdir3))
										{
											mkdir($path."critical/".$subdir3);
										}

										foreach($subdirs4 as $subdir4)
										{
											if(is_dir($subdir4))
											{
												if(!is_dir($path."critical/".$subdir4))
												{
													mkdir($path."critical/".$subdir4);
												}
												
												$subdirs5=glob($subdir4."/*");
												foreach($subdirs5 as $subdir5)
												{
													//Start SUBDIR5
													if(is_dir($subdir5))
													{
														if(!is_dir($path."critical/".$subdir5))
														{
															mkdir($path."critical/".$subdir5);
														}
														
														$subdirs6=glob($subdir5."/*");
														foreach($subdirs6 as $subdir6)
														{
															//Start SUBDIR3
															if(is_dir($subdir6))
															{
																if(!is_dir($path."critical/".$subdir6))
																{
																	mkdir($path."critical/".$subdir6);
																}
																
																$subdirs7=glob($subdir6."/*");
																foreach($subdirs7 as $subdir7)
																{
																	//Start SUBDIR3
																	if(is_dir($subdir7))
																	{
																		if(!is_dir($path."critical/".$subdir7))
																		{
																			mkdir($path."critical/".$subdir7);
																		}
																		
																		$subdirs8=glob($subdir7."/*");
																		foreach($subdirs8 as $subdir8)
																		{
																			//Start SUBDIR3

																			//End SUBDIR3
																		}
																	}
																	else
																	{
																		copy($subdir7, $path."critical/".$subdir7);
																	}
																	//End SUBDIR3
																}
															}
															else
															{
																copy($subdir6, $path."critical/".$subdir6);
															}
															//End SUBDIR3
														}
													}
													else
													{
														copy($subdir5, $path."critical/".substr($subdir5, 5,strlen($subdir5)));
													}
													//End SUBDIR5
												}
											}
											else
											{
												copy($subdir4, $path."critical/".$subdir4);

											}
										}
									}
									else
									{
										copy($subdir3, $path."critical/".$subdir3);

									}
									//End SUBDIR3
								}
							}
							else
							{
								
								copy($subdir2, $path."critical/".$subdir2);


								
							}
						}
					}
					else
					{
							copy($subdir, $path."critical/".$subdir);
						
					}
				}
			}
			else
			{
				copy($item, $path."critical/".$item);
				
			}
		}
	}
	
}
else
{
	echo "Active";
}
?>