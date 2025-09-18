<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <!-- Outer table for background color -->
    <table width="100%" bgcolor="#f4f4f4" cellpadding="0" cellspacing="0" border="0" style="padding: 20px;">
        <tr>
            <td align="center" valign="top">
                <!-- Main email container -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border: 1px solid #dddddd; border-radius: 5px;">
                    <tr>
                        <td style="padding: 20px;">
                            <!-- Email content -->
                            @php
                                $processedContent = $htmlContent;
                                
                                // Replace CID references with embedded logo paths
                                if (isset($emailLogos) && is_array($emailLogos)) {
                                    foreach ($emailLogos as $logo) {
                                        $cidPattern = '/cid:' . preg_quote($logo['cid'], '/') . '/';
                                        $embedPath = $message->embed(storage_path('app/public/' . $logo['path']));
                                        $processedContent = preg_replace($cidPattern, $embedPath, $processedContent);
                                    }
                                }
                            @endphp
                            
                            {!! $processedContent !!}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>