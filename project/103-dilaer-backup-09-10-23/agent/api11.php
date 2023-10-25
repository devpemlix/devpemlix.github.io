<?php


 
$DonarName=htmlspecialchars($_GET["first_name"]);
$DonarTitle=htmlspecialchars($_GET["title"]);
$ContactPerson=htmlspecialchars($_GET["user"]);
$OrganizationName=htmlspecialchars($_GET["phone_number"]);
$Address=htmlspecialchars($_GET["address1"]);
$Address2=htmlspecialchars($_GET["address2"]);
$Landmark=htmlspecialchars($_GET["address3"]);
$EmailId=htmlspecialchars($_GET["email"]);
$Pincode=htmlspecialchars($_GET["postal_code"]);
$ContactNo=htmlspecialchars($_GET["dialed_number"]);
$AlternateNo=htmlspecialchars($_GET["alt_phone"]);
$City=htmlspecialchars($_GET["city"]);
//$DonationMode=htmlspecialchars($_GET["phone_number"]);
//$LocationName=htmlspecialchars($_GET["state"]);
//$AgencyName=htmlspecialchars($_GET["phone_number"]);
$UID=htmlspecialchars($_GET["user"]);
$Comments=htmlspecialchars($_GET["comments"]);






$url="http://supportapps.savethechildren.in/LIVE/LeadsAPI/Show?uId=$UID&email=$EmailId&AltNo=$AlternateNo&name=$DonarName&title=$DonarTitle&contactNo=$ContactNo&add1=$Address&add2=$Address2&pin=$Pincode&city=$City&donationMode=$DonationMode&landmark=$Landmark&comments=$Comments";

?>
<div>
    <iframe id='iframe2' src="<?php echo $url; ?>" frameborder="0" style="overflow: hidden; height: 100%;
        width: 100%; position: absolute;" height="100%" width="100%"></iframe>
</div>

