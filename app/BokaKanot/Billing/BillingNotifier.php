<?php namespace App\BokaKanot\Billing;

use App\BokaKanot\Interfaces\BillingNotifierInterface;
use Illuminate\Support\Facades\Mail;

class BillingNotifier implements BillingNotifierInterface
{
    public function notifyAdmin(KlarnaAdminNotifierBookingDetailsAbstract $parameters)
    {
        $parameters->product_list = (isset($this->postedProducts['product_list']) ? $this->postedProducts['product_list'] : null);

        $subject = 'Product Request';
        //$total_cost = $this->postedProducts['total_input_price'];
        //$product_list = (isset($this->product_list['product_list']) ? $this->postedProducts['product_list'] : null);
        //$product_name = $this->postedProducts['product_name'];

        $numb_recipients = count($parameters->recipients);
        $to = $parameters->recipients[0];

        for($i = 1; $i < $numb_recipients; $i++)
        {
            $to .= ', ' . $parameters->recipients[$i];
        }

        $message = "<html>
                <body>
                <p>Full name: ".$parameters->name."</p>
                <p>Email: ".$parameters->email."</p>
                <p>Adress: ".$parameters->address."</p>
                <p>Postal Code ".$parameters->postal_code."</p>
                <p>Product List</p>
                <table border='1' style='border-collapse: collapse;border: 1px solid black;'>
                <tr>
                  <td>Product Name</td>
                  <td>Product Cost</td>
                </tr>";

        if (!empty($parameters->product_list))
        {
            foreach($parameters->product_list as $key => $value) {

                $message .= "<tr>
                    <td>".$value->name."</td>
                    <td>".$value->quantity."</td>
                 </tr>";
            }
        }


        $message .= "<tr>
                    <td>Total Cost</td>
                    <td>".$parameters->total_cost."</td>
                 </tr>";

        $message .= "</table>
              </body>
              </html>";

        $headers = 'From: '.$parameters->name.' ' .$parameters->email. "\r\n";
        $headers .= "Content-type: text/html\r\n";

        $send = mail($to, $subject, $message, $headers); //This method sends the mail.
        //$send = 1;
        //Mail::send('emails.welcome', [], function($message)
        /*Mail::send([], [], function($message)
        {
            $message->to('peter@puschel.se')->subject('Welcome');
        });*/

        try{
            $mess = ('Successfully sent.');
            exit(json_encode(array('error' => false, 'message' => $mess)));
        }
        catch (Exception $e) {

            $mess = ('An error occured. Please refresh the page.'. $e);

            exit(json_encode(array('error' => true, 'message' => $mess)));
        }
       /* if ($send)
        {


        } else {

        }*/

    }
}