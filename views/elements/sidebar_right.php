<?php
use yii\helpers\Url;
$base_url = Url::home(true);

?>
<div class="wrapper">
    <div class="header">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
            <tbody>
            <tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                        <tbody>
                        <tr>
                            <td width="100%">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                    <!-- Spacing -->
                                    <tr>
                                        <td width="100%" height="10"></td>
                                    </tr>
                                    <!-- Spacing -->
                                    <tr>
                                        <td>
                                            <!-- logo -->
                                            <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <div class="imgpop">
                                                            <a target="_blank" href="#">
                                                                <img src="<?=isset($image) ? $image : ''?>" class="success-image" alt="" border="0" style="border:none; outline:none; text-decoration:none;">
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <!-- end of logo -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="100%" height="10"></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- text -->
    <table width="100%" bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="full-text">
        <tbody>
        <tr>
            <td>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                    <tr>
                        <td width="100%">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                <tbody>

                                <tr>
                                    <td>
                                        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                            <tbody>


                                            <tr>
                                                <td width="100%" height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <p class="message_text" style="font-size: 15px;text-align: center;margin-bottom: 40px;">
                                                    <?=isset($message) ? $message : ''?>
                                                </p>
                                                <p style="text-align: center;">
                                                    <a href="<?=$base_url?><?=isset($button_link) ? $button_link : ''?>" target="_blank" class="activation_link"><?=isset($button) ? $button : ''?></a>
                                                </p>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                </tr>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <table width="100%" bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
        <tbody>
        <tr>
            <td>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                    <tr>
                        <td width="100%">
                            <?=isset($footer) ? $footer : ''?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>