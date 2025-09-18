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