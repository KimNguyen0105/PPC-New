<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://perfectpropertyvn.com/</loc>
    </url>
    <url>
        <loc>https://perfectpropertyvn.com/ppc-project.html</loc>
    </url>
    <url>
        <loc>https://perfectpropertyvn.com/project-rent.html</loc>
    </url>

    <url>
        <loc>https://perfectpropertyvn.com/project-sale.html</loc>
    </url>
    <url>
        <loc>https://perfectpropertyvn.com/about-ppc.html</loc>
    </url>
    <url>
        <loc>https://perfectpropertyvn.com/ppc-news.html</loc>
    </url>
    <url>
        <loc>https://perfectpropertyvn.com/ppc-recruitment.html</loc>
    </url>
    <url>
        <loc>https://perfectpropertyvn.com/ppc-hrpolicies.html</loc>
    </url>
    <url>
        <loc>https://perfectpropertyvn.com/ppc-contact.html</loc>
    </url>
    @foreach($tintuc as $post)
        <url>
            <loc>https://perfectpropertyvn.com//tin-tuc/{{ $post->id}}-{{ $post->slug }}.html</loc>
        </url>
    @endforeach
    @foreach($project as $p)
        <url>
            <loc>https://perfectpropertyvn.com//tin-tuc/{{ $p->id}}-{{ $p->slug }}.html</loc>
        </url>
    @endforeach
</urlset>