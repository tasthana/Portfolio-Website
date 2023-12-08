<?php
    include 'top.php';

    // initialize all values --------------------------------------------------------------------------------------------

    $dataIsGood = false;

    $message = '';

    $email = '';
    $review = '';


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
                // end validation --------------------------------------------------------------------------------------------

                //save data  ------------------------------------------------------------------------------------------------------------------------------------------
                if($dataIsGood){
                    try{


                        if($statement->execute($data))
                        {
                            $message = '<h2> Thank you, your feedback is always appreciated!</h2>';

                            //email code ------------------------------------------------------------------------------------------------------------------------------------------
                            $to = $email;
                            $from = 'Tushar Asthana <tasthana@uvm.edu>';
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
                    <li>This is where you can contact me! Ask me any questions about my resume or just leave a review</li>
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

                          <p>
                            <input id="chkSweatshirts" name="chkSweatshirts" tabindex="530"
                            type="checkbox" value="1" <?php if($sweatshirts) print 'checked'; ?>>
                            <label for="chkSweatshirts">Sweatshirts</label>
                          </p>
                    </fieldset>
                </form>

