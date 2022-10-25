<div class="email_main_div" style="max-width: 700px;margin-left: auto;margin-right: auto;">
    <div class="email_header" style="background-color: #2e343c;padding: 10px;padding-left: 30px;">
        <img style="height: 40px;" src="images/Logo-white.png" alt="">
    </div>

    <div class="email_content" style="padding: 30px;">
        <h4>Welcome! to <b>rad.</b>sol</h4>
        <p style="font-family:  Courier New, monospace;">"Always deliver more than expected"</p>
        <div class='email-body'>
            <?php echo $email_body ?>
            <!-- <p style="font-size: 12px;color: #555;">Hi, <br> your <b>Meet</b>Here Login has been set up for you and you can now login to your account.</p>
            <p style="font-size: 12px;color: #555;">Administration area using the address and log in details below:</p> -->
        </div>
        <hr>
        <?php if (isset($data)) { ?>
            <table>
                <tr style="height: 60px;">
                    <td style="width: 60px;"><span class="email_icon"><i class="fas fa-globe"></i></span></td>
                    <td>
                        <span style="font-size: 12px; font-weight: 600;">Visit Our Website</span>
                        <br>
                        <span style="font-size: 12px; font-weight: 600; color: #bf1e2e;"><?php echo base_url(); ?></span>
                    </td>
                </tr>

                <tr style="height: 60px;">
                    <td><span class="email_icon" style="background-color: #f8e8ea;color: #bf1e2e;font-size: 14px;height: 30px;width: 30px;display: block;text-align: center;line-height: 30px;border-radius: 3px;"><i class="fas fa-envelope"></i></span></td>
                    <td>
                        <span style="font-size: 12px; font-weight: 600;">Your Email:</span>
                        <br>
                        <span style="font-size: 12px; font-weight: 600; color: #bf1e2e;"><?php echo $data['email'] ?></span>
                    </td>
                </tr>

                <tr style="height: 60px;">
                    <td><span class="email_icon"><i class="fas fa-lock"></i></span></td>
                    <td>
                        <span style="font-size: 12px; font-weight: 600;">Your Password:</span>
                        <br>
                        <span style="font-size: 14px;"><?php echo $data['password'] ?></span>
                    </td>
                </tr>
            </table>
            <br>
            <a href="<?php echo base_url(); ?>" class="email_login_btn" style="background-color: #bf1e2e;border: none;color: #fff;padding: 8px 20px;border-radius: 5px;cursor: pointer;">Login in here</a>
         <?php } ?> 
    </div>

    <div class="email_footer" style="background-color: #2e343c;padding: 10px;padding-left: 30px;">
        <p style="color: #fff;font-size: 12px;">Please visit our website <a style="color: #fff;font-size: 12px;" href="https://radosol.com/">RadOSol</a></p>
        <p style="color: #fff;font-size: 12px;">If your have any further questions, please don't hesitate to email us at <a style="color: #fff;font-size: 12px;" href="#">support@bookmy.estate</a></p>
    </div>

    <div style="font-size: 12px; padding: 30px;">
        <p>Sincerely, <br> Rad Sol Team</p>
    </div>

</div>