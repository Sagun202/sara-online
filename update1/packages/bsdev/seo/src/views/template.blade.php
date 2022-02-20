<title>{{ $title }}</title>
<meta name="description" itemprop="description" content="{{ $description }}" />
<meta name="keywords" content="{{ $keywords }}" />

<meta property="og:description" content="{{ $description }}" />
<meta property="og:title" content="{{ $title }}" />
<meta property="og:url" content="{{ env("APP_URL") }}" />
<meta property="og:site_name" content="{{ env("APP_NAME") }}" />
<meta property="og:image" content="{{ $image }}" />


<meta name="twitter:card" content="{{ $description }}" />
<meta name="twitter:title" content="{{ $title }}" />