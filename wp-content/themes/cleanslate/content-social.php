<?php
    // Social Media Sharing
    $title = urlencode(get_the_title());
    $group = urlencode('Y&M Architecture');
    $handle = urlencode('YMArch');
    $url = urlencode(get_permalink());
    $desc = urlencode(get_the_excerpt());
    $subj = $title . '+|+' . $group;
    $tweet = '%23' . $handle . '+' . $title . ',+' . $url;
    $body = urlencode('Check out this article from ') . $group . ':+' . $url;
    $thumb_social = get_thumbnail_custom($post->ID, 'thumbnail');
?>

<ul class="social-icons">
    <li>
        <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $subj; ?>&amp;p[summary]=<?php echo $desc; ?>&amp;p[url]=<?php echo $url; ?>&amp;&amp;p[images][0]=<?php echo $thumb_social[0];?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="facebook" title="Share on Facebook." target="_blank"></a>
    </li>
    <li>
        <a onClick="window.open('http://twitter.com/intent/tweet?text=<?php echo $tweet; ?>','sharer','toolbar=0,status=0,width=548,height=225');" href="javascript: void(0)" class="twitter" title="Tweet this" target="_blank"></a>
    </li>
    <li>
        <a href="mailto:?subject=<?php echo $subj; ?>&amp;body=<?php echo $body; ?>" class="email" title="Share by Email" target="_blank"></a>
    </li>
    <li>
        <a onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>&amp;title=<?php echo $subj; ?>&amp;summary=<?php echo $desc; ?>','sharer','toolbar=0,status=0,width=548,height=425');" href="javascript: void(0)" class="linked-in" title="Share on LinkedIn." target="_blank"></a>
    </li>
</ul>