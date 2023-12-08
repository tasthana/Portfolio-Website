<?php
    include 'top.php';

    // initialize all values --------------------------------------------------------------------------------------------

    $dataIsGood = false;

    $message = '';

    $email = '';
    $review = '';

    $hats = false;
    $babytee = false;
    $sweatshirts = false;

    $city = 'Nashville';

    // post back function push thru special chars
    function getData($field) {
        if (!isset ($_POST[$field])) {
            $data = "";
        } else {
            $data = trim($_POST[$field]);
            $data = htmlspecialchars($data);
        }
        return $data;
    }

    function verifyAlphaNum($testString) {
        // Check for letters, numbers and dash, period, space and single quote only.
        // added & ; and # as a single quote sanitized with html entities will have
        // this in it bob's will be come bob's
        return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
    }
?>

        <main>

            <section>

            <?php
            if($_SERVER["REQUEST_METHOD"] == 'POST')
            {
                //sanitize start --------------------------------------------------------------------------------------------
                $email = getData('txtEmail');
                $review = getData('txtReview');

                $hats = (int) getData('chkHats');
                $babytee = (int) getData('chkBabytee');
                $sweatshirts = (int) getData('chkSweatshirts');

                $city = getData('radCity');
                //sanitize end --------------------------------------------------------------------------------------------


                //validate form --------------------------------------------------------------------------------------------
                $dataIsGood = true;

                if($email =='')
                {
                    print '<p class = "wrong"> Please type in your email again. </p> ';
                    $dataIsGood = false;
                }
                elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    print '<p class = "wrong"> Email must be wrong, try again! </p> ';
                    $dataIsGood = false;
                }

                if($review =='')
                {
                    print '<p class = "wrong"> Please type in your review again. </p> ';
                    $dataIsGood = false;
                }

                // validate check boxes --------------------------------------------------------------------------------------------
                $totalChecked = 0;

                if($hats != 1) $hats = 0;
                $totalChecked += $hats;

                if($babytee != 1) $babytee = 0;
                $totalChecked += $babytee;

                if($sweatshirts != 1) $sweatshirts = 0;
                $totalChecked += $sweatshirts;

                if($totalChecked == 0)
                {
                    print '<p class="wrong"> Please choose a product please! </p>';
                    $dataIsGood = false;
                }

                // validate radio boxes --------------------------------------------------------------------------------------------
                if ($city != "Nashville" AND $city != "Hawaii" AND $city != "SaltLake")
                {
                    print '<p class = "wrong"> Please tell me which city to travel to next! </p> ';
                    $dataIsGood = false;
                }
                // end validation --------------------------------------------------------------------------------------------

                //save data  ------------------------------------------------------------------------------------------------------------------------------------------
                if($dataIsGood){
                    try{
                        $sql ='INSERT INTO tblCOP(fldEmail, fldCustom, fldReview, fldHats, fldBabytee, fldSweatshirts, fldCity)
                        VALUES (?,?,?,?,?,?,?)';
                        $statement = $pdo->prepare($sql);
                        $data = array($email, $review, $hats, $babytee, $sweatshirts, $city);

                        if($statement->execute($data))
                        {
                            $message = '<h2> Thank you, your feedback is always appreciated!</h2>';

                            //email code ------------------------------------------------------------------------------------------------------------------------------------------
                            $to = $email;
                            $from = 'Coat of Paint <tasthana@uvm.edu>';
                            $subject = 'Confirmation Email';

                            $headers = "MIME-Version: 1.0\r\n";
                            $headers .= "Content-type: text/html; charset=utf-8\r\n";
                            $headers .= "From: " . $from . "\r\n";

                            $mailMessage = '<p style= "background-color:rgb(8, 75, 14); font: 12pt serif; color: #009;"> I really do appreciate the feedback ';
                            $mailMessage .= 'that you have provided me, and I will take it as guidance! I closely read every response that I recieve!';
                            $mailMessage .= 'and if I have any every questions!</p>';
                            $mailMessage .= '<p style= "background-color:rgb(8, 75, 14); font: 12pt serif; color: #009;"> Wish you well on your future travels, <br><span "padding-left: 5em;"> </span>';
                            $mailMessage .= 'Tushar Asthana </p>';

                            $mailSent = mail($to, $subject, $mailMessage, $headers);

                            if($mailSent)
                            {
                                print "<p> A copy has been emailed to you for your records!</p>";
                            }

                        } else{
                            $message = '<p> Something went wrong, records were not saved. </p>';
                        }
                    }catch(PDOException $e){
                        $message = '<p> Something went wrong, contact your administrator. </p>';
                        echo 'Error: ' . $e->getMessage();
                    }
                }//data is good  ------------------------------------------------------------------------------------------------------------------------------------------

            } //ends form submitted ------------------------------------------------------------------------------------------------------------------------------------------
            ?>

                <section class="gallery content">

                <ul>
                    <li>This is where you can contact me! Ask me any questions, place a custom order, or just leave a review</li>
                    <li> Remeber everything ships from New Hampshire! Shorter shipping distances are kinder to the planet.</li>
                    <li>Materials are all gildan based products.</li>
                    <li>All clothes are handmade!</li>
                </ul>
                </div>
                </section>

                <form action="#" id= "frmNext" method="post">

                    <fieldset class="contact">
                        <legend>What's your email?</legend>
                        <p>
                            <label class="required" for="txtEmail"></label>
                            <input id="txtEmail" maxlength="50" name="txtEmail"
                            onfocus="this.select()" tabindex="110" type="text" value="<?php print $email; ?>"
                            required>
                        </p>
                    </fieldset>

                    <fieldset class="review">
                        <legend>Please leave a review of the website!</legend>
                        <p>
                            <label class="review" for="txtReview" ></label>
                            <input id="txtReview" maxlength="300" name="txtReview"
                            onfocus="this.select()" tabindex="110" type="text" value="<?php print $review; ?>"
                            required>
                        </p>
                    </fieldset>

                    <fieldset class="checkbox">
                        <legend>What's your favorite COP product?</legend>
                        <p>
                            <input id="chkHats" name="chkHats" tabindex="510"
                            type="checkbox" value="1" <?php if($hats) print 'checked'; ?>>
                            <label for="chkHats">Hats</label>
                        </p>

                        <p>
                            <input id="chkBabytee" name="chkBabytee" tabindex="520"
                            type="checkbox" value="1" <?php if($babytee) print 'checked'; ?>>
                            <label for="chkBabytee">Baby Tee!</label>
                        </p>

                        <p>
                            <input id="chkSweatshirts" name="chkSweatshirts" tabindex="530"
                            type="checkbox" value="1" <?php if($sweatshirts) print 'checked'; ?>>
                            <label for="chkSweatshirts">Sweatshirts</label>
                        </p>
                    </fieldset>
