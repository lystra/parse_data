                                <!--Begin text upload-->
\                   <?php
										if(isset($_POST['submit_string']))
										{
                    //Begin processing string to check for missing quotation marks
										?>
										<h3>Content Succesfully Uploaded!</h3>
										<?
										$string = nl2br($_POST['string']);
										$Quotekeyword = '"';
										$Periodkeyword = '.. ';

										$string_wout_breaks = str_replace("/n", "", $_POST['string']);
										$string_up_to_last_quote = substr(strrchr($string, '"'), -30, 0);

										$countQuotes = substr_count($string, '"');
										$countPeriods = substr_count($string, '.');

										$string_length = mb_strlen( $string );
										$last_occurence = substr(strrchr($string, '"'), 0, 30);
										$last_period = substr(strrchr($string, '.. '), 0, 30);

										// Add custom highlighting to quotation marks found
										$search = '"';
										$highlight = '<span id="highlighted">\1</span>';
                    $all_content_with_highlighted_quotes = str_highlight($string, $search, STR_HIGHLIGHT_SIMPLE, $highlight);

											if (strpos($string,'"') !== false)
											{
                       //Quotation marks have been found in the string
												if($countQuotes % 2 != 0)
												{
                        //If number of quotes not divisible by two, you are missing a quote somewhere.
												echo '<h2>You are missing a quotation mark!</h2>';
												echo "Number of quotes found: ".$countQuotes;
												echo "<br />Last quotation found: <br />".$last_occurence;
												}
												else
												{
												echo '<h2>You are all set! No missing quotations!</h2>';
												echo "Number of quotes found: ".$countQuotes;
												echo "<br />Number of Characters: ".$string_length;
												}
											}
											else
											{
                      //No quotation marks have been found in the string
											echo "<h2>You have no quotations in your text</h2>";
											}

											echo '<br /><br /><h2>Your Uploaded Content</h2>'.$all_content_with_highlighted_quotes;
											print '<br /><br /><a href="./">Import new content</a>';
										}
										else
										{
                    //Show form to input string
										?>
										<h3>Paste Your Text Below</h3>
										<form action="" method="post">
										<textarea id="text" name="string" class="animated" placeholder="Paste your text here.." onclick="return hideText();"></textarea>
										<br /><br />
										<input type="submit" name="submit_string" value="Proof My Work!" class="ctaEntice">
										</form>
										<?
										}
										?>
										<br />
										<br />
										<?
										function highlight($text, $words) {
											preg_match_all('~\w+~', $words, $m);
											if(!$m)
											return $text;
											$re = '~\\b(' . implode('|', $m[0]) . ')\\b~';
											return preg_replace($re, '<b>$0</b>', $text);
										}
										$words = ".";
										print highlight($text, $words);
                    ?>
                    <!--End text upload-->
