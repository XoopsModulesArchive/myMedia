<?php

//  ------------------------------------------------------------------------ 	//
//                XOOPS - PHP Content Management System    				//
//                    Copyright (c) 2004 XOOPS.org                       	//
//                       <https://www.xoops.org>                              //
//                   										//
//                  Authors :									//
//						- solo (www.wolfpackclan.com)         	//
//						- christian (www.edom.org)		 	//
//						- herve (www.herve-thouzard.com)   		//
//						- Marcan (www.smartfactory.ca)   		//
//                  myMedia v2.3								//
//  ------------------------------------------------------------------------ 	//

require_once 'admin_header.php';
xoops_cp_header();
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
$module_id = $xoopsModule->getVar('mid');
require_once '../include/nav.php';

echo "<br><a href='http://www.wolfpackclan.com/wolfactory' target ='_blank'><img src='../images/logo_03.gif' align='right' alt='Go to the WolFactory'></a>
<p align='center'><strong><font size='5'>How to use myMedia ?</font>
</strong></p>
<br><br><strong><u>GENERAL</u></strong>
<br>myMedia is a derivated module of Edito from the <a href='http://www.wolfpackclan.com/wolfactory/' target ='_blank'>WolFactory</a>. It has been designed to easily display pictures and mymedia on a Xoops site. For webmasters, pictures can be added either from the administration side, or directly from a link in the index myMedias of the module.<br><br>

<font color='blue'><strong><u>myPINUP BLOCK SELECTION</u></strong><br>
There are different way to use myMedia blocks:<br><br>
1) Display a new Pinup everyday: activat the '<b>Today's Pinup</b>' block.<br><br>
2) Display a random Pinup: activat the '<b>Random Pinup</b>' block.<br><br>
Note that if you desactivate the '<b>Display in popup</b>' option, the picture link will lead to the pinup myMedia (important if you want people to comment your pictures). There are still plenty of other possibilities to display your pictures (or mymedia). See latest points - 3.b. <br><br></font>

<font color='red'><strong><u>myPINUP PICTURE MODIFICATION</u></strong><br>
If you want to replace the current pictures used in this module, you may need to follow the next principles:<br><br>
1) Select all the pictures you want to display and put them in a custom directory.<br><br>
2) Name all the pictures as following : 'pi<i>XXX</i>.jpg' where <i>XXX</i> is a number ranking from 001 to 366.<br><br>
3) upload the directory in the 'module/myMedia/images/' directory.<br><br>
4) Go in 'module settings', and spot '<b>[LOGO] Image upload directory</b>' option. Change 'pinup' directory with the name of your custom directory. <br><br></font>
<u>Note</u> : If you need a utility to rename all your pictures on the fly, we warmly recommand you to use <a href='http://www.herve-thouzard.com/modules/wfsection/article.php?articleid=3' target='_blank'>TheRename</a> from <a href='http://www.herve-thouzard.com'>www.herve-thouzard.com</a>.<br><br>

As this module is based on the same principle as the Edito modules, you may find below explanations on how to use it.<br><br><strong><u>FEATURES</u></strong>
<br>One of the main objective of this module is to allow users or webmasters who are not used to web or module management to easily display articles or similar material on their site. Other benefits include plenty of features that allow the webmaster to personalise the use of the module. This includes very flexible block mymedia allowing many disply type options, as we will see later in this short guide. Another top feature is the ability to display mymedia meta information such as keywords and description within the myMedia html. This can be set on a module basis in admin and also parsed on an individual myMedia basis. <br><br><strong><u>CREDITS</u>
</strong>
<br>With respect to the design and creation of this module, credits and thanks go to several well-known xoopers: <br>Christian, Herv&eacute;, Marcan, Carnuke and Solo for their help and collaboration on this project.<br><br><strong><u>ADMINISTRATION<br></u>
</strong>
<br><strong>1) <u>Preferences (or module general settings)</u>
</strong>
<br><br>Before using this myMedia module, I suggest to have a careful look at the admin settings. This is where you will define the functional and personal settings of your module. Those settings have a direct impact on the mymedia myMedias, blocks and admin preferences.<br><br>They are all classified in sections, indicated by square braces around each [SECTION NAME] as follows:.<br><br><strong>a) [INDEX]</strong>
<br><br>Define the main index myMedia settings:<br><br><strong><em>~Intro: <br></em>
</strong>
Put here the text you want to see above the myMediapersonalizedisplayHTML list. This text accept Xoops and HTML codes.<br><br>Index Columns: Ranging from 1 to 5, it defines the number of columns to display the myMedias.<br><br><strong><em>~Order:</em>
</strong>
 The myMedias order in the displayed list &ndash; <br>* Title in alphabetical order <br>* The most recent first <br>* The most viewed. <br><br>Note that if you use the two last method, the myMedia title will show up the publication date or number of view.<br><br><strong><em>~Maximum articles per myMedia:</em>
</strong>
 <br>Ranging from 5 to 50, it defines the amount of myMedias to display in the main myMedia. If your amount of myMedias is bigger than this number, a myMedia index number will automatically show up at the bottom of the index myMedia. Note that this option affects the number of myMedias to display in the admin index also.<br><br><strong><em>~Logo&rsquo;s width:</em>
</strong>
 <br>Regardless of the real size of the logo you have uploaded on the server, this setting will automatically resize the picture width for each and every myMedia&rsquo;s pictures. Note that an undersized picture would keep its original size.<br><br><strong><em>~Show icons: <br></em>
</strong>
define whether or not you want to show the &lsquo;popular&rsquo; (most read) or &lsquo;new&rsquo; (most recent) icon in the main myMedia.<br><br><strong><em>~New icons (in days):</em>
</strong>
 <br>fix the value in days to define whether the myMedia is new or not. Default is set to 7, but there are no limits.<br><br><strong><em>~Popularity icons:</em>
</strong>
 <br>fix the value of views to define whether the myMedia is popular or not. Default is set to 100, but there are no limits.<br><br><strong>b) [MYMEDIA]</strong>
<br><br>Define Admin myMedia&rsquo;s mymedia.<br><br><strong><em>~Default text:</em>
</strong>
 <br>You can set an default myMedia mymedia for each and every new myMedia created. This can be useful if you want to keep or define some particular template for you mymedia.<br><br><br><strong>c) [ADMIN]</strong>
<br><br>Define admin preferences.<br><br><strong><em>~Date Format: <br></em>
</strong>
Set the display date format for all articles.<br><br><strong><em>~Admin counter read: <br></em>
</strong>
define whether or not you want the counter to consider admin as a visit. Default is set to &lsquo;no&rsquo;.<br><br><strong><em>~Use WYSIWYG myMediar: <br></em>
</strong>
define whether or not you want to use the koivi myMediar. If set to no, myMedia will use the standard DHTML Xoops myMediar.<br><br><br><strong>d) [LOGO]</strong>
<br><br>Define the Logo (pictures, images) basic settings in the admin.<br><br><strong><em>~Maximum upload size:</em>
</strong>
 <br>Sets the maximum file size allowed when uploading files. This option is restricted to max upload permitted on the server.<br><br><strong><em>~Maximum image width: <br></em>
</strong>
Sets the maximum allowed width of an image when uploading.<br><br><strong><em>~Maximum image height:</em>
</strong>
 <br>Sets the maximum allowed height of an image when uploading.<br><br><strong><em>~Images base directory: <br></em>
</strong>
This is the directory which holds the operational images. (No trailing '/')<br><br><strong><em>~Image upload directory: <br></em>
</strong>
This is the directory where illustration pics will be stored. Don&rsquo;t forget to CHMOD 777 the upload myMedia directory if you are using this one!<br>(No trailing '/')<br><br><strong><em>~Logo alignment: <br></em>
</strong>
Select the alignment of the logo for each and every myMedia. You can choose, left, right or top middle.<br><br><br><strong>e) [EXT_OPTIONS]</strong>
<br><br>Define extended options available for each and every new myMedia.<br><br><strong><em>~Extended options :</em>
</strong>
 <br>If you select yes, the below options would be available for each and every new myMedia. If not, they won&rsquo;t display, and the current option would be used as default.<br><br><strong><em>~Show Title:</em>
</strong>
 <br>Define whether you want to display or hide myMedia&rsquo;s title.<br><br><strong><em>~Show in Sub-Menu: </em>
</strong>
<br>Define whether you want to display or hide myMedia&rsquo;s in the main menu as sublink of the myMedia&rsquo;s module main link.<br><br><strong><em>~Show Logo:</em>
</strong>
 <br>Define whether you want to display or hide myMedia&rsquo;s logo/picture.<br><br><strong><em>~Show Block&rsquo;s mymedia:</em>
</strong>
 <br>Define whether you want to display or hide myMedia&rsquo;s related block mymedia. Thanks to the use of the [blockbreak] tag, you can define here if you want to see the block mymedia in the myMedia myMedia.<br><br><strong><em>~Show 'Back to index' link: <br></em>
</strong>
Define whether you want to display or hide the &ldquo;back to index&rdquo; link at the bottom of the myMedia. This can be useful when you want to use myMedia to display a unique myMedia which is unrelated to the rest of the module&rsquo;s mymedia.<br><br><strong><em>~Module Meta Keywords: <br></em>
</strong>
myMedia automatically creates Meta Keywords from the titles/mymedia of your mymedia myMedia. However, you can add here the custom keywords you would like to add on each myMedia of this module.<br><br><strong><em>~Module Meta Description: <br></em>
</strong>
You can customize here the meta description of the myMedias inside your module. If this text area is empty, the default Meta Description of your site will prevail.<br><br><strong>f) Misc.</strong>
<br>Classical comment features…<br><br><strong><em>~Comment Rules: </em>
</strong>
<br>Define the general comments rules on your module.<br><br><strong><em>~Allow anonymous post in comments:</em>
</strong>
 <br>Self-explanatory.<br><br><br><strong>2) <u>Admin Index</u>
</strong>
<br><br>There are 3 different parts here : Module navigation bar, Block administration navigation bar and myMedia&rsquo;s list.<br><br><strong>a) Module navigation bar consisting of-</strong>
 <br>* Go to Index Page<br>* Settings<br>* myMedias' list<br>* Create a myMedia<br><br>You can navigate through the whole module and it&rsquo;s option thanks to this nav bar. Keep in mind that on each and every myMedia generated by myMedia, as admin of the module, you will be able to directly access the edit, delete or administration function.<br>The 'Go to index myMedia' link is important because you need to click this first, then select any myMedia to view before gaining access to the edit link.<br><br><strong>b) Block administration bar consiting of -</strong>
<br>Visible Bloc Admin :<br><br>* myMedia 1<br>* myMedia random<br>* myMedia latest<br>* myMedia popular<br>* Menu myMedia<br>* Menu myMedia bis<br><br>This admin bar links directly to the available myMedia&rsquo;s blocks (2 + 4 available). There are two types of blocks :<br>- Menu block : which display all the available myMedias as a list. 2 available.<br>- myMedia block : which display one myMedia&rsquo;s mymedia in the block. 4 available.<br><br>Red means they are set offline, while green indicates online.<br><br>See above for more about blocks settings.<br><br><strong>c) myMedia&rsquo;s list<br></strong>
<br>Here is the table list of all the available myMedias. As for the index, the number of available myMedia on one myMedia is defined by the related admin setting. See [INDEX] Maximum articles per myMedia. An myMedia set to green is said to be online, while a myMedia set to red is said offline. An offline myMedia won&rsquo;t be visible in the main menu list, in the index myMedia or in the block Menu. However, all myMedia&rsquo;s (online or offline) are still available through direct links or in mymedia block to an admin.<br><br><br><strong>3) <u>Available related blocks</u>
</strong>
<br><br>One of the most important features of myMedia module is the blocks. As stated above, you have 2 menu blocks, 4 mymedia linked blocks. Why so many? Because for each and every available blocks, you can have a very wide range of applications and options.<br><br>When editing a myMedia block, use the &ldquo;Setting&rdquo; option.<br><br><strong>a) Menu Block</strong>
<br>There are 2 of them. You can display the myMedia list under 3 different forms:<br>- Main menu like (no pictures)<br>- Unordered list (no pictures)<br>- Pictures<br>You can define the default picture width and the number of columns the list has to be displayed (but only in picture mode). The last option allows you to define the order you want the links to be displayed : <br><br>*Title ascending, title descending, most recent or oldest, or the top viewed.<br><br><strong>b) Content Blocks</strong>
<br>There are 4 of them. You can display the myMedia mymedia 8 different ways:<br><br><em>~Random:</em>
 <br>pick randomly a myMedia (must be online).<br><br><em>~Latest:</em>
 <br>display the most recent myMedia (must be online).<br><br><em>~Most viewed (or most popular):</em>
 <br>displays the most viewed myMedia (must be online).<br><br><em>~Linked to myMedia:</em>
 <br>this block will display the current myMedia&rsquo;s block mymedia. That is, if you are on the myMedia 1, the block will display the myMedia 1 block&rsquo;s mymedia (thanks to the [blockbreak] fconsistingon-lineon-lineon lineon lineon lineon lineunction).<br><br><em>~Each day of the year, of the month, of the weekday:</em>
 <br>those functions are linked to the myMedia&rsquo;s id. Let say we are the day 71 of the year, it would display the myMedia number 71.<br><br><em>~Specific myMedia: </em>
<br>you can define a specific myMedia to be displayed in the current block. Just pick it in the list. It can be offline or not.<br><br>You can also define whether you want to show the title or the related picture or not. And of course, your can define the max. length of the text to be displayed, which can be useful if you are not using the <em>[blockbreak]</em>
 tag. <br><br>Thanks for choosing myMedia, as always, we are happy to receive any comments and feedback so that we may continually improve the quality and features of this module.<br><br>- The authors";

xoops_cp_footer();
?>
