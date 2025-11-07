<?php
// app/controllers/MessageController.php

require_once __DIR__ . '/../core/Controller.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MessageController extends Controller {

    /**
     * يستقبل بيانات نموذج الاتصال، يتحقق منها، يحفظها في DB، ثم يرسل إيميلين.
     */
    public function sendMail() {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
            exit;
        }
        
        $formErrors = array();
        
        // --- 1. التصفية والتنظيف (Sanitization) ---
        // استخدام strip_tags لإزالة أكواد HTML الضارة و htmlspecialchars للتجهيز الآمن للعرض.
        $name = htmlspecialchars(strip_tags(trim($_POST['name'] ?? ''))); 
        $subject = htmlspecialchars(strip_tags(trim($_POST['subject'] ?? ''))); 
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['phone'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $message = htmlspecialchars(strip_tags(trim($_POST['message'] ?? ''))); 

        // --- 2. التحقق من الصحة (Validation) ---
        // التأكد من أن جميع الحقول المطلوبة مستوفاة
        if (empty($name) || strlen($name) < 2) { 
            $formErrors[] = 'Full Name must be larger than 2 characters.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $formErrors[] = 'Email is not valid.';
        }
        if (empty($subject)) {
            $formErrors[] = 'Subject cannot be empty.';
        }
        if (empty($message) || strlen($message) < 10) {
            $formErrors[] = 'Message must be larger than 10 characters.';
        }
        $phoneRegex = '/^(010|011|012|015)[0-9]{8}$/';
        if (!empty($phone) && (!preg_match($phoneRegex, $phone) || strlen($phone) !== 11)) {
            $formErrors[] = 'The phone number must be 11 digits and start with 010, 011, 012, or 015.';
        }

        // --- 3. التعامل مع النتائج (إرسال الإيميلات عند النجاح) ---
        if (empty($formErrors)) {
            // تنفيذ الحفظ في قاعدة البيانات
            $messageModel = $this->model('Message');
            $saved = $messageModel->addMessage($name, $email, $phone, $subject, $message);

            if ($saved) {
                $email_success_message  = "";
                try {
                    $mail = new PHPMailer(true);
                    // إعدادات SMTP العامة
                    $mail->isSMTP();
                    $mail->Host       = MAIL_HOST;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = MAIL_USERNAME;
                    $mail->Password   = MAIL_PASSWORD;
                    $mail->SMTPSecure = MAIL_ENCRYPTION;
                    $mail->Port       = MAIL_PORT;
                    $mail->CharSet    = 'UTF-8'; // دعم اللغة العربية
                    
                    // ===============================================
                    //  الخطوة 1: إرسال الرسالة الأساسية إليك (البورتفوليو)
                    // ===============================================
                    $mail->setFrom(MAIL_USERNAME, 'Portfolio Contact Form');
                    $mail->addAddress(MAIL_USERNAME); 
                    $mail->addReplyTo($email, $name); 
                    $mail->isHTML(true);
                    $mail->Subject = 'NEW MESSAGE: ' . $subject;
                    $mail->Body    = "
                        <h1>New Contact Message from Portfolio</h1>
                        <hr>
                        <p><strong>Name:</strong> {$name}</p>
                        <p><strong>Email:</strong> {$email}</p>
                        <p><strong>Phone:</strong> {$phone}</p>
                        <p><strong>Subject:</strong> {$subject}</p>
                        <hr>
                        <p><strong>Message:</strong></p>
                        <div style='border: 1px solid #ccc; padding: 15px; background: #f9f9f9;'>
                            " . nl2br($message) . "
                        </div>
                    ";
                    $mail->send();
                    
                    // ===============================================
                    //  الخطوة 2: إرسال الرد الآلي إلى المرسل ($email)
                    // ===============================================
                    
                    // إعداد رسالة جديدة للمرسل
                    $mail->ClearAllRecipients();
                    $mail->ClearReplyTos(); 
                    $mail->setFrom(MAIL_USERNAME, 'Osama Portfolio'); // الإرسال من بريدك (MAIL_USERNAME)
                    $mail->addAddress($email, $name); // المستقبل هو المستخدم الذي أرسل
                    
                    $mail->Subject = 'Thank you for contacting us | Confirmation of receipt';
                    
                    // محتوى رسالة الرد الآلي باللغة العربية مع تنسيق بسيط
                    $mail->Body = "
                        <div style='direction: rtl; text-align: right; font-family: Tahoma, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px;'>
                            <h1 style='color: #007bff; border-bottom: 2px solid #eee; padding-bottom: 10px; font-size: 24px;'>Thank you so much for contacting me {$name}!</h1>
                            <p style='font-size: 16px; line-height: 1.6; color: #333;'>Your message has been successfully received and I appreciate your interest in communicating.</p>
                            <p style='font-size: 16px; line-height: 1.6; color: #333;'>I will review your message regarding: <strong>{$subject}</strong> I will reply to you personally as soon as possible (usually within 24 hours).</p>
                            
                            <h3 style='color: #555; margin-top: 30px; border-top: 1px dashed #eee; padding-top: 10px;'>Summary of your message:</h3>
                            <div style='background: #f8f8f8; padding: 15px; border-radius: 5px; border-left: 5px solid #007bff; color: #555; font-size: 14px;'>
                                <p style='margin: 0;'><strong>the topic:</strong> {$subject}</p>
                                <p style='margin: 0;'><strong>Part of the message:</strong> " . nl2br(substr($message, 0, 150)) . (strlen($message) > 150 ? '...' : '') . "</p>
                            </div>
                            
                            <br>
                            <p style='margin-top: 20px; color: #333;'>With sincere greetings and appreciation,</p>
                            <p style='font-weight: bold; color: #007bff;'>Osama</p>
                        </div>
                    ";

                    // إرسال الرد الآلي
                    $mail->send();

                    $email_success_message = "Your message was sent successfully, and we have sent you a confirmation message to your email.";

                } catch (Exception $e) {
                    $email_success_message = "The message was saved, but email sending failed. Check your SMTP settings. Error: {$mail->ErrorInfo}";
                }

                // الرد بالنجاح (المتصفح يستلم هذا فور انتهاء كل العمليات)
                echo json_encode([
                    'success' => true, 
                    'message' => "Your message has been sent and saved successfully." . $email_success_message
                ]);
                exit;

            } else {
                // فشل الحفظ
                echo json_encode([
                    'success' => false, 
                    'message' => "The message failed to be saved to the database. Please try again."
                ]);
                exit;
            }
            
            // مسح بيانات الفورم المخزنة مسبقاً بعد النجاح
            // unset($_SESSION['form_data']);
            // unset($_SESSION['form_errors']);

        } else {
            // ❌ توجد أخطاء: نخزن المدخلات والأخطاء في الـ Session
            echo json_encode([
            'success' => false, 
            'message' => "Please correct the following errors:", 
            'errors' => $formErrors // نرسل الأخطاء المفصلة
            ]);
            exit;
            // $_SESSION['form_errors'] = $formErrors;
            // $_SESSION['form_data'] = [
            //     'name' => $_POST['name'] ?? '',
            //     'email' => $_POST['email'] ?? '',
            //     'subject' => $_POST['subject'] ?? '',
            //     'phone' => $_POST['phone'] ?? '',
            //     'message' => $_POST['message'] ?? '',
            // ];
            
        }
        
        // إعادة التوجيه إلى صفحة الاتصال
        // header("Location: " . BASE_URL . "#contact");
        // exit;
    }
}