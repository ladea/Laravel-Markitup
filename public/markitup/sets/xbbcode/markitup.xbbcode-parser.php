<?php
// ----------------------------------------------------------------------------
// markItUp! XBBCode Parser
// v 1.0
// Dual licensed under the MIT and GPL licenses.
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Nicolas Froidure
// http://www.elitwork.com/
// http://bbcomposer.elitwork.com/
// ----------------------------------------------------------------------------
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
// 
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
// 
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.

function XBBCode2Html($string)
	{
	$all=false; $cleanup=false;
	$tags = array('span', 'kbd', 'var', 'del', 'ins', 'div', 'strong', 'em', 'dfn', 'cite', 'q', 'blockquote', 'p', 'br', 'a', 'ol', 'ul', 'li', 'abbr', 'acronym', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'hr', 'pre', 'address', 'img', 'tr', 'th', 'td', 'table', 'caption', 'thead', 'tfoot', 'tbody', 'dl', 'dd', 'dt', 'map', 'area', 'code', 'samp', 'sub', 'sup');
	array_push($tags, 'script', 'object', 'param'); // peuvent être commentés (+sécurité)
	$attributes = array('class', 'id', 'name', 'dir', 'title', 'lang', 'style', 'href', 'hreflang', 'rel', 'rev', 'tabindex', 'type', 'accesskey', 'charset', 'datetime', 'cite', 'alt', 'longdesc', 'usemap', 'src', 'coords', 'shape', 'nohref', 'summary', 'scope');
	array_push($attributes, 'onclick', 'ondblclick', 'onkeydown', 'onkeypress', 'onkeyup', 'onload', 'onmousedown', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onunload', 'onblur', 'onfocus', 'defer', 'value', 'data', 'width', 'height'); // peuvent être commentés (-sécurité)
	$tagChars='abcdefghijklmnopqrstuvwxyz0123456789';
	$attributeChars='abcdefghijklmnopqrstuvwxyz';
	$curTextNode='';
	$curHtml='';
	for($i=0; $i<strlen($string); $i++)
		{
		$curTag='';
		$curTagBegin=-1;
		$opClTag=false;
		$curAtt='';
		$curAttBegin=-1;
		$curAttVal='';
		$curAttValBegin=-1;
		$lastSpaceInAtt=-1;
		if($string[$i]=='[')
			{
			if($curTextNode)
				{
				$curHtml.=$curTextNode;
				}
			$curTextNode='';
			$curTagBegin=$i;
			if($string[$i+1]=='/')
				{
				// Tag close loop
				for($i=$i+2; $i<strlen($string); $i++)
					{
					if(strpos($tagChars,$string[$i])!==false)
						$curTag.=$string[$i];
					else
						break;
					}
				if(!($curTag&&($all||in_array($curTag,$tags))))
					{
					$curTextNode.='[/'.$curTag.$string[$i];
					continue;
					}
				else if($i>=strlen($string)||$string[$i]!=']')
					{
					$curTextNode.='[/'.$curTag.$string[$i];
					continue;
					}
				$curHtml.='</'.$curTag.'>';
				}
			else
				{
				$curTextNode='';
				for($i=$i+1; $i<strlen($string); $i++)
					{
					if(strpos($tagChars,$string[$i])!==false)
						$curTag.=$string[$i];
					else
						break;
					}
				if($curTag&&($all||in_array($curTag,$tags)))
					{
					$curHtml.='<'.$curTag;
					if($i+1<strlen($string)&&$string[$i]=='/'&&$string[$i+1]==']')
						{
						$opClTag=true;
						}
					else if($i+2<strlen($string)&&$string[$i]==' '&&$string[$i+1]=='/'&&$string[$i+2]==']')
						{
						$opClTag=true;
						}
					else if($i+1<strlen($string)&&$string[$i]==' '&&strpos($attributeChars,$string[$i+1])!==false)
						{
						while($string[$i]==' ')
							{
							$curAttBegin=$i+1;
							for($i=$i+1; $i<strlen($string); $i++)
								{
								if(strpos($attributeChars,$string[$i])!==false)
									{
									$curAtt.=$string[$i];
									continue;
									}
								else
									{
									if(in_array($curAtt,$attributes))
										{
										$curHtml.=' '.$curAtt.'="';
										$curAttValBegin=$i+1;
										}
									else
										{
										$curAtt='';
										$curAttValBegin=$i+1;
										}
									break;
									}
								}
							if($string[$i]=='=')
								{
								for($i=$i+1; $i<strlen($string); $i++)
									{
									if($string[$i]==']')
										{
										break;
										}
									else if($i<strlen($string)&&$string[$i]=='/'&&$string[$i+1]==']')
										{
										$opClTag=true;
										break;
										}
									else if($i<strlen($string)&&$string[$i]==' '&&$string[$i+1]=='/'&&$string[$i+2]==']')
										{
										$opClTag=true;
										break;
										}
									else if($string[$i]!=' ')
										{
										if($lastSpaceInAtt>=0)
											{
											if($string[$i]=='=')
												{
												$i=$lastSpaceInAtt;
												break;
												}
											else if(strpos($attributeChars,$string[$i])===false)
												$lastSpaceInAtt=-1;
											}
										continue;
										}
									else
										{
										$lastSpaceInAtt=$i;
										}
									}
								$curAttVal.=substr($string,$curAttValBegin,$i-$curAttValBegin);
								}
							else
								{
								if($i<strlen($string)&&$string[$i]=='/'&&$string[$i+1]==']')
									{
									$opClTag=true;
									}
								else if($i<strlen($string)&&$string[$i]==' '&&$string[$i+1]=='/'&&$string[$i+2]==']')
									{
									$opClTag=true;
									}
								}
							if($curAtt)
								{
								$curHtml.=$curAttVal.'"';
								}
							$curAtt='';
							$curAttBegin=-1;
							$curAttVal='';
							$curAttValBegin=-1;
							$lastSpaceInAtt=-1;
							if($opClTag&&$string[$i]==' ')
								{
								$i++;
								}
							}
						}
					else if($string[$i]!=']')
						{
						$curHtml=substr($curHtml,0,strlen($curHtml)-strlen($curTag)-1);
						$curTextNode.='['.$curTag.$string[$i];
						continue;
						}
					while($opClTag&&$string[$i]!=']')
						$i++;
					if($opClTag)
						{
						$curHtml.=' /';
						$opClTag=false;
						}
					$curHtml.='>';
					}
				else
					{
					$curTextNode.='['.$curTag.$string[$i];
					continue;
					}
				}
			}
		else
			{
			$curTextNode.=$string[$i];
			}
		}
	if($curTextNode)
		{
		$curHtml.=$curTextNode;
		}
	if($cleanup)
		{
		$curHtml=preg_replace('/\[(?:[^\]]+)\]/i', '', $curHtml);
		}
	return $curHtml;
	}