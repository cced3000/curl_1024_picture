<?php 
echo "系统当前时间戳为：";
echo "<br/>";
echo time();
//<!--JS 页面自动刷新 -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
echo ("setTimeout('fresh_page()',1000);");      
echo ("</script>");
?>

<?php
//header("Content-type:text/html ; charset=utf-8");
/*global $fresh;
$fresh=30000;*/
function getcheckimage($link){
			//header('Content-Type:image/png');
		$mh = curl_multi_init();	//创建多线程批量的句柄
			$title_1=$link;
			$link1=$link;
		$link="http://hnalady.com/blog-entry-".$link.".html";
		//     http://cl.orer.biz/htm_data/7/1601/1812752.html
		
		     
		$ch=curl_init($link);
		//	$ch=curl_init("http://wzjw.sdwz.cn/student/student_qm_cj.aspx");
		//$ch=curl_init("http://wzjw.sdwz.cn/student/xsksap.aspx");
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_TIMEOUT,100);  
		/*curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');*/
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//回去返回输出流,注释便会输出页面内
		
		
		$txt=trim(curl_exec($ch));  
		//echo $txt;
		curl_close($ch);
		//preg_match_all('/點擊小圖即可見大圖,(.*?)快速回帖>/',$txt,$match_title1);
		//$txt=$match_title1[1][0];
	 // $ok=preg_match_all('navi_next(.*?)body>/',$txt,$match_title);
	  if(true){
	  //echo $txt;
/*  $reg_tag = '/<img.*?\"([^\"]*(jpg|bmp|jpeg|gif)).*?>/';*/
			$reg_tag = '/img src="(.*?)" alt=/';
			 preg_match_all($reg_tag,$txt,$match_image);
		   createfile($title_1);
		  $filename="";
		 
		  for($i=0;$i<count($match_image[1]);$i++){
		  
			 grabImage($match_image[1][$i],$filename,$title_1);
			 // echo $match_image[1][$i]."<br>";
			 
		  }
		/*  for($l=count($match_image[1]);$l>12;$l--){
		  
			 grabImage($match_image[1][$l],$filename,$title_1);
			 // echo $match_image[1][$i]."<br>";
			 
		  }*/
		  
	  }
	//  else{$fresh=1000;}

			 }	
			 
 function grabImage($url,$filename="",$title){
	if ($url == "") return false;
    if($filename == "") {
		$ext=strrchr($url,"."); //获取扩展名
		$ext_arr = array(".gif",".png",".jpg",".bmp");
		//判断扩展名是否为图片
		if (!in_array($ext, $ext_arr)) return false;
		//我就随便将图片文件名保存为时间戳了，你可自行修改
		$filename = $title."/".time().$ext;
	}
	
$img1=file_get_contents($url);
file_put_contents($filename, $img1);
	
	
	/*ob_start(); //打开浏览器的缓冲区
	readfile($url); //将图片读入缓冲区
	$img = ob_get_contents(); //获取缓冲区的内容复制给变量$img
	ob_end_clean(); //关闭并清空缓冲
	$fp = @fopen($filename,"a"); //将文件绑定到流
	fwrite($fp,$img); //写入文件
	fclose($fp); //关闭文件之争*/
	//return $filename;
}	
			 
	function createfile($fileName){		
	$fileName=$fileName. '/'; // 获取需要创建的文件名称
        if (!is_dir($fileName)) mkdir($fileName, 0777); // 使用最大权限0777创建文件
        if (!file_exists($fileName)) { // 如果不存在则创建
    // 检测是否有权限操作
	 if (!is_writetable($fileName)) chmod($fileName, 0777); // 如果无权限，则修改为0777最大权限
    // 最终将d写入文件即可
    file_put_contents($fileName, 'd');
} 
   
	}	
	$txt_db = '123.txt';
         $nums = file_get_contents($txt_db);
         $nums++;
         file_put_contents($txt_db,$nums);
	 getcheckimage($nums);
	 echo "第".$nums."帖子爬取成功<br>";
		 
	//getcheckimage("1813089");




?>
