<?php 

//Post the form submission to the same page as the form is on. 
//Set the redirect header location after form submission to the SAME PAGE with a GET URL request(?status=thanks)

//FORM INPUT ESCAPING - PREVENT SQL INJECTION

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
    $details = trim(filter_input(INPUT_POST,"details", FILTER_SANITIZE_SPECIAL_CHARS));
    $year = trim(filter_input(INPUT_POST,"year", FILTER_SANITIZE_STRING));
    $title = trim(filter_input(INPUT_POST,"title", FILTER_SANITIZE_STRING));
    $category = trim(filter_input(INPUT_POST,"category", FILTER_SANITIZE_STRING));
    $genre = trim(filter_input(INPUT_POST,"genre", FILTER_SANITIZE_STRING));
    $format = trim(filter_input(INPUT_POST,"format", FILTER_SANITIZE_STRING));


//FORM VALIDATION

if($name == "" || $email == "" || $category == "" || $title == "") {
$error_message = "Please fill in the required fields: Name, Email, Category and Title.";
}

//HONEYPOT CONDITIONAL

if (!isset($error_message)  &&  $_POST["address"] != "") {
$error_message = "You're a bot, I fooled you!";
}

if(!isset($error_message) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
$error_message = "Not a valid email address";
}

if(!isset($error_message)) {
  
$email_from = "Andrew Gale <mail.google.com.au>";
$email_subject = "Media Suggestion";
$mailaddress = "andrewgnew@gmail.com";

$headers = 'From: andrewgnew@gmail.com' . "\r\n" .
'Reply-To: andrewgnew@gmail.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();


$output = array(
    "Name:" => $name, 
    "Email:" =>$email,
    "Year:" => $year,
    "Title:" => $title,
    "Category:" => $category,
    "Genre:"=> $genre,
    "Format:"=> $format,
    );


$message = "";
foreach($output as $key => $item) {
$message .= $key . " " . $item . "\n";
echo $message;
};

//Send email
$to = 'andrewgnew@gmail.com';

mail($to, $message, $headers, $email_subject);

}

if(!isset($error_message)) {
header("location: ?status=thanks");
    }
}


$pageTitle = "Suggest a Media Item";
$section = "suggest";
include ("inc/header.php");

?>

<div class = "section page">

<div class="wrapper">

<h1>Suggest a media item</h1>


<!---Add a conditional after the H1 to echo out the thank you message if the form has been POSTED.
Remember to enclose the HTML form in the PHP ELSE statement -->


<?php if(isset($_GET["status"]) && $_GET["status"] == "thanks") {
echo "<p>Thanks for the email! Ill check out your suggestion shortly.</p>";
} else { 
if(isset($error_message)) {
        echo '<p class="message">' . $error_message . '</p>';   
} else {    
echo '<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an email.</p>';
}        
?>


<form method="POST" action="suggest.php">
<table>
<tr>
<th><label for="name">*Name:</label></th>
<td><input type="text" name="name" id="name" value="<?php if(isset($name)){ 
echo $name;}
?>"></td>
</tr>

<tr>
<th><label for="email">*Email:</label></th>
<td><input type="text" name="email" id="email" value="<?php if(isset($email)){ 
echo $email;}
?>"</td>
</tr>

<tr>
<th><label for="category">*Category:</label></th>
<td><select id ="category" name="category">
<option value ="">Select One</option>
<option value ="Books"<?php if(isset($category) && $category == "Books") echo "selected";?>>Books</option>
<option value ="Movies" <?php if(isset($category) && $category == "Movies") echo "selected";?>>Movies</option>
<option value ="Music" <?php if(isset($category) && $category == "Music") echo "selected";?>>Music</option>

</select>

<tr>
<th><label for="title">*Title:</label></th>
<td><input type="text" name="title" id="title" value="<?php if(isset($title)){ 
echo $title;}
?>"></td>
</tr>

<tr>
<th><label for="format">Format:</label></th>
<td><select id ="format" name="format">
<option value="">Select One</option>

<optgroup label ="Books">Books</option>
<option value="Audio">Audio</option>
<option value="Ebook">Ebook</option>
<option value="Hardback">Hardback</option>
<option value="Paperback">Paperback</option>
</optgroup>

<optgroup label ="Movies">Movies</option>
<option value="Blu-ray">Blu-ray</option>
<option value="DVD">DVD</option>
<option value="Streaming">Streaming</option>
<option value="VHS">VHS</option>
</optgroup>

<optgroup label ="Music">Music</option>
<option value="Cassette">Cassette</option>
<option value="CD">CD</option>
<option value="MP3">MP3</option>
<option value="Vinyl">Vinyl</option>
</optgroup>

</select>

<tr>
<th><label for="title">Genre:</label></th>
<td><select id ="genre" name="genre">
<option value="">Select One</option>

<optgroup label="Genre">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Historical">Historical</option>
                            <option value="Historical Fiction">Historical Fiction</option>
                            <option value="Horror">Horror</option>
                            <option value="Magical Realism">Magical Realism</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Paranoid">Paranoid</option>
                            <option value="Philosophical">Philosophical</option>
                            <option value="Political">Political</option>
                            <option value="Romance">Romance</option>
                            <option value="Saga">Saga</option>
                            <option value="Satire">Satire</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Tech">Tech</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Urban">Urban</option>
                        </optgroup>
</td>
</tr>


<tr>
<th><label for="year">Year:</label></th>
<td><input type="text" name="year" id="year" value="<?php if(isset($year)){ 
echo $year;}
?>"></td>
</tr>


</td>
</tr>


<tr>
<th><label for="details">Additional details:</label></th>
<td><textarea name="details" id="details">
<?php if(isset($details)){
    echo htmlspecialchars($_POST['details']);
}
?>
</textarea>
</tr>

<!--Honeypot form field against SPAM-->

<tr style="display: none">
<th><label for="address">Address:</label></th>
<td><input type="text" name="address" id="address" value="<?php if(isset($address)){ 
echo $address;}
?>">
<p>Please leave this field blank if you see it.</p>
</td>
</tr>


</table>

<input type="submit" value="send"></submit>


</form>
<?php } ?>


<div class="results">


</div>

</div>
</div>

<?php include('inc/footer.php')?>
