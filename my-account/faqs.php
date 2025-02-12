<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Navigation FAQs</title>
    <!-- Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./asssets/css/sidenav.css">
    <link rel="stylesheet" href="./asssets/css/chat.css">
    <style>
        .faq-section {
            margin-bottom: 15px;
        }
        .faq-question {
            cursor: pointer;
            padding: 10px 15px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .faq-question:hover {
            background-color: #e7e7e7;
        }
        .faq-answer {
            padding: 15px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 4px 4px;
        }
    </style>
</head>
<body>
<nav class="sidebar">
        <?php include '.././components/user-nav.php'; ?>
    </nav>
    <div class="main-content">
  
        <h1 class="text-center">Frequently Asked Questions</h1>
        
        <div class="panel-group" id="faqAccordion">
            <div class="faq-section panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse1">
                            How to register as a user?
                        </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p>To register, you need to provide:</p>
                        <ul>
                            <li>Basic information</li>
                            <li>1x1 ID photo</li>
                            <li>Valid documents such as:
                                <ul>
                                    <li>Brgy. Certificate of Residency</li>
                                    <li>Birth Certificate</li>
                                    <li>Or 2 Valid IDs</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="faq-section panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse2">
                            How to see if you are verified?
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>Go to the home page</li>
                            <li>Click on the "Verify Now" button</li>
                            <li>You will be redirected to the verification page</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="faq-section panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse3">
                            What is needed for verification?
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li>Exact name</li>
                            <li>Birthday</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="faq-section panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse4">
                            How to make an appointment?
                        </a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>Go to your User dashboard</li>
                            <li>Navigate to the "Appointments" section</li>
                            <li>Select the date you want to appoint</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="faq-section panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse5">
                            How to contact the office?
                        </a>
                    </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>Go to your User dashboard</li>
                            <li>Navigate to the "Messages" section</li>
                            <li>From there, you can contact the admin staff for inquiries</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="faq-section panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse6">
                            How to track my Applications/ID?
                        </a>
                    </h4>
                </div>
                <div id="collapse6" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>Go to your User dashboard</li>
                            <li>Navigate to "My Applications"</li>
                            <li>There you can see:
                                <ul>
                                    <li>If your IDs are still being processed</li>
                                    <li>If your IDs are in the delivery state</li>
                                    <li>If your Registration is still in process</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 3 JS and jQuery (required for Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html> 