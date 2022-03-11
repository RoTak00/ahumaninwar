<?php
session_start();


include_once 'modules/functions/mod-functions.php';
$current_page = "about";
$current_page_title = "About";

?>


<!DOCTYPE html>
<html lang="en">
<head>

<?php include "modules/html/mod-head.php"; ?>

</head>
<body style = "background-color: #ededed;">
<?php include "modules/html/mod-navbar.php"; ?>

<div class = "mt-2 p-2">
    <h2 class = "display-2 text-center"> A Human in War</h2>
    <p class = "lead text-center" style = "margin-top: -12px;"> What's our goal? </p>
</div>
<!-- GOAL ------>
<div class = "container mt-2 py-2 px-4 mb-2">
    <p style = "text-align: justify;"> The "A Human in War" project was created in order to raise awareness regarding the current situation across Ukraine. <!--We believe that 
        the media does too little to present the effects of this increasing conflict towards individuals, only focusing on the general image, disregarding
        feelings of the people that are being opressed and put in extremely difficult, stressful and dangerous situations.--> 
        We believe that giving the individuals directly affected by this increasing conflict the opportunity to share their story is one of the best ways to present
        the ongoing events. This way, the feelings and emotions of every human put in these extremely difficult, stressful and dangerous situations are not to be disregarded.</p>
    <!--<p style = "text-align: justify;"> The "A Human in War" name attempts to encourage the world into considering these ongoing conflicts as more than simple geopolitical conflicts.
        Instead of seeing a war as a game to be dicussed, and instead of attempting to justify a war because of previous historical or geopolitical events, we should try to
        be empathic and help out as much as possible.</p>-->
    <p style = "text-align: justify;"> Through the "A Human in War" project, we encourage everyone directly affected by the ongoing events to share their story with us,
        either with their real name or a pseudonym/alias, and to tell us how they're handling everything that's going on - if they're safe, where they are now, how and what they are feeling. 
        A representative image of the situation is also encouraged, because we all know that "an image says more than a thousand words". </p>
    <p style = "text-align: justify;"> We believe that seeing the stories, uncensored and honest, coming from simple people, just like we are, contributes
        to raising awareness for everyone that's not directly affected by this conflict. Everyone can help, either by spreading these stories further
        or by donating to organizations dedicated to helping people in need. Therefore, here you can also find links to several organizations that can take donations and help. </p>
</div>
<!-- NGOS -->
<div class = "container mt-2 py-2 px-4 mb-2">
    <h4> NGO's dedicated to children: </h4>
    <ul>
        <li> <a href = "https://tabletochki.org/" target = "_blank">Tabletochki</a> </li>
        <li> <a href = "https://voices.org.ua/" target = "_blank">Voices of Children</a> </li>
        <li> <a href = "https://www.oasukraine.org/" target = "_blank">Orphan's Aid</a> </li>
        <li> <a href = "https://www.savethechildren.org.uk/where-we-work/europe/ukraine " target = "_blank">Save the Children</a> </li>
    </ul>

    <h4> NGO's dedicated to the elderly: </h4>
    <ul>
        <li> <a href = "https://letshelp.com.ua/ " target = "_blank">Let's help</a> </li>
        <li> <a href = " https://starenki.com.ua/" target = "_blank">Starenki</a> </li>
    </ul>

    <h4> NGO's dedicated to medical aid: </h4>
    <ul>
        <li> <a href = "https://www.projecthope.org/" target = "_blank">Project HOPE</a> </li>
        <li> <a href = "http://monstrov.org/" target = "_blank">Monsters, Inc.</a> </li>
        <li> <a href = "http://unitedhelpukraine.org/ " target = "_blank">United Help Ukraine</a> </li>
        <li> <a href = "https://www.rsukraine.org/" target = "_blank">Revived Soldiers Ukraine</a> </li>
        <li> <a href = "https://www.icrc.org/en/where-we-work/europe-central-asia/ukraine" target = "_blank">Red Cross Ukraine</a> </li>
    </ul>

    <h4> NGO's dedicated to free journalism: </h4>
    <ul>
        <li> <a href = "https://kyivindependent.com/ " target = "_blank">The Kyiv Independent</a> </li>
    </ul>

    <h4> NGO's dedicated to animals: </h4>
    <ul>
        <li> <a href = "https://happypaw.ua/ua" target = "_blank">Happy Paw</a> </li>
        <li> <a href = "https://dogcat.com.ua/" target = "_blank">Sirius</a> </li>
    </ul>

</div>

<!-- BISTRITA HELP -->

<!--
<div class = "container mt-2 py-2 px-4 mb-2">
<h4> Helping from Bistrița-Năsăud?</h4>
    <p> Interact Bistrița-Nosa is an organized club of young volunteers, located in the Bistrița-Năsăud County, in the North-West Region of Romania, acting
        under the patronage of the Rotary Club Bistrița-Năsăud.</p>
    <p>Several institutions and organization from Bistrița-Năsăud are collecting food and sanitary products for refugees in our country. </p>
    <p><strong>In Bistrița</strong></p>
    <ul><li>CNLR together with the Impact organization are collecting in <strong>Bistrița, Bulevardul Republicii, nr. 8, building B (Gymnasium), ground floor</strong></li>
    <li>CNAM together with the Impact organization are collecting in <strong>Bistrița, Bulevardul Republicii nr. 26, small sports hall.</strong></li>
<li>Școala Gimnazială nr. 1 Bistrița together with the "Organizația Salvatorilor Sufletelor Nimănui" is collecting at <strong>Bistrița, Bulevardul Independenței, nr. 46, Str. Împăratul Traian entry</strong> from 28th February, details <strong>0743 487 265</strong> or <strong>0743 073 763</strong></li>
</ul>
<p><strong>In Cepari:</strong><br /> "Alină un Suflet" organization, through ms. <a href="https://www.facebook.com/yonela.surugiu" target="_blank" rel="noopener">Yonela Căluș Surugiu</a>.</p>
<p><strong>In Mijlocenii Bârgăului:</strong><br /> "Alină un Suflet" organization, through ms. <a href="https://www.facebook.com/ionela.urs.14" target="_blank" rel="noopener">Ionela Urs</a>.</p>
<strong>What can you donate?</strong>
<ul>
<li>Bottled water</li>
<li>Non-perishable food</li>
<li>Food cans</li>
<li>Powdered Milk</li>
<li>Hygiene Products</li>
<li>Pampers</li>
<li>Medicine (Paracetamol, Aspirin, Nurofen, Ibuprofen)</li>
<li>Animal food</li>
<li>Blankets</li>
<li>Sweets</li>
</ul>
</div>

 CONTACT 

<div class = "mt-2 p-2">
    <h4 class = "display-4 text-center"> Who are we?</h4>
</div>

<div class = "container mt-2 py-2 px-4 mb-2">
<p style = "text-align: justify;"> This website was developed by the volunteering youth club Interact Bistrița-Nosa, set up under the auspices of Rotary Club Bistrița Nosa,
a non-governamental, non-profit organization, member of <a href = "https://www.rotary.org/en" target = "_blank">Rotary International</a>. One of the global missions of Rotary
is peace, and together with them, we join the international community in raising awareness and bringing the stories of people and fellow teenagers closer to the ears of the world.</p>
</p>
<p style = "text-align: justify;"> If you are facing problems and need any type of support, contact us via our Instagram or Facebook page - we're here to help in you any way,
if you need assistance, if you need help or information about Romania or if you just need to talk to someone. </p>
<a class = "w-75 d-block mx-auto btn btn-dark my-4" role = "button" href = "https://www.instagram.com/interactbistritanosa/?hl=en">Interact Bistrița-Nosa</a>
<img class = "img-fluid w-50 d-block d-md-none mx-auto" src = "images/Sigla_Interact_Negru.png">
<img class = "img-fluid w-25 d-none d-md-block mx-auto" src = "images/Sigla_Interact_Negru.png">
</div>-->

<div class = "container d-none d-md-block mt-2 py-2 px-4 mb-2">
    <p class = "text-center" style = "font-size: 15px;">
        This project is a proud representer of the <strong>#WeStandForPeace</strong> movement.<br>Join us, spread the word, raise awareness and help as much as you can. For peace! </p>
    </p>
    
</div>
<div class = "container d-block d-md-none mt-2 py-2 px-4 mb-2">
    <p style = "text-align: justify;">
        This project is a proud representer of the <strong>#WeStandForPeace</strong> movement.<br>Join us, spread the word, raise awareness and help as much as you can. For peace! </p>
    </p>
</div>

<?php include "modules/html/mod-footer.php"; ?>
<?php include "modules/html/mod-scripts.php"; ?>
</body>
</html>