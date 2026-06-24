@php
    $shareUrl = $shareUrl ?? url()->current();
    $shareTitle = $shareTitle ?? '';
@endphp

<div class="article-share" id="articleShare" data-share-url="{{ $shareUrl }}" data-share-title="{{ $shareTitle }}">
    <button type="button" class="share-btn" id="shareBtn" aria-label="Share this page" aria-haspopup="true" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="18" cy="5" r="3"/>
            <circle cx="6" cy="12" r="3"/>
            <circle cx="18" cy="19" r="3"/>
            <path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"/>
        </svg>
    </button>

    <div class="share-menu" id="shareMenu" role="menu" hidden>
        <button type="button" class="share-menu-item" role="menuitem" id="copyLinkBtn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.07 0l2.83-2.83a5 5 0 0 0-7.07-7.07L11.5 4.5"/><path d="M14 11a5 5 0 0 0-7.07 0L4.1 13.83a5 5 0 0 0 7.07 7.07L12.5 19.5"/></svg>
            <span id="copyLinkLabel">Copy link</span>
        </button>

        <div class="share-menu-divider"></div>

        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="bluesky" data-track="cta_click" data-track-label="Share Bluesky">
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 8.5c-.9-1.8-3.4-5.1-5.7-6.7C4 0.2 3 0.7 3.3 2.6c.1.4.3 2.6.5 3.6.6 3.3 1.5 4.1 4.5 4.6-3.1.5-3.9 1.6-5.1 3.6-1 1.7.1 4 2.2 3.5 1.6-.4 3-1.5 4.6-4 1.6 2.5 3 3.6 4.6 4 2.1.5 3.2-1.8 2.2-3.5-1.2-2-2-3.1-5.1-3.6 3-.5 3.9-1.3 4.5-4.6.2-1 .4-3.2.5-3.6.3-1.9-.7-2.4-3-.8C15.4 3.4 12.9 6.7 12 8.5Z"/></svg>
            Share on Bluesky
        </a>
        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="facebook" data-track="cta_click" data-track-label="Share Facebook">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9.5"/><path d="M14.5 8.5h-1.2c-1 0-1.3.5-1.3 1.3V11h2.3l-.3 2.3H12V19h-2.4v-5.7H8V11h1.6V9.6c0-1.9 1-3.4 3.1-3.4h1.8z" fill="currentColor" stroke="none"/></svg>
            Share on Facebook
        </a>
        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="linkedin" data-track="cta_click" data-track-label="Share LinkedIn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2.5"/><path d="M7.5 10.5V17M7.5 7.5v.01M12 17v-4a2 2 0 0 1 4 0v4M12 13v4" stroke-linecap="round"/></svg>
            Share on LinkedIn
        </a>
        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="threads" data-track="cta_click" data-track-label="Share Threads">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16.5 7.2c-1-1-2.2-1.5-3.7-1.5-3.4 0-5.6 2.6-5.6 6.3s2.2 6.3 5.7 6.3c2.9 0 4.8-1.4 4.8-3.7 0-1.8-1.2-2.9-3.3-3.2-1.7-.3-3.1-.1-3.6.7-.4.6-.1 1.4.7 1.7.6.2 1.2 0 1.4-.5"/></svg>
            Share on Threads
        </a>
        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="twitter" data-track="cta_click" data-track-label="Share X">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 5l14 14M19 5 5 19"/></svg>
            Share on X
        </a>
    </div>
</div>

<script>
(function () {
    var shareWrap = document.getElementById('articleShare');
    if (!shareWrap || shareWrap.dataset.shareBound === '1') return;
    shareWrap.dataset.shareBound = '1';

    var shareBtn = document.getElementById('shareBtn');
    var shareMenu = document.getElementById('shareMenu');
    var shareUrl = shareWrap.dataset.shareUrl;
    var shareTitle = shareWrap.dataset.shareTitle;

    var links = {
        bluesky: 'https://bsky.app/intent/compose?text=' + encodeURIComponent(shareTitle + ' ' + shareUrl),
        facebook: 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl),
        linkedin: 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(shareUrl),
        threads: 'https://www.threads.net/intent/post?text=' + encodeURIComponent(shareTitle + ' ' + shareUrl),
        twitter: 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(shareTitle) + '&url=' + encodeURIComponent(shareUrl),
    };
    shareMenu.querySelectorAll('[data-share]').forEach(function (link) {
        link.href = links[link.dataset.share];
    });

    function closeMenu() {
        shareMenu.hidden = true;
        shareBtn.setAttribute('aria-expanded', 'false');
    }
    function openMenu() {
        shareMenu.hidden = false;
        shareBtn.setAttribute('aria-expanded', 'true');
    }

    shareBtn.addEventListener('click', function (e) {
        e.stopPropagation();

        if (shareMenu.hidden) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    document.addEventListener('click', function (e) {
        if (!shareWrap.contains(e.target)) closeMenu();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMenu();
    });

    var copyBtn = document.getElementById('copyLinkBtn');
    var copyLabel = document.getElementById('copyLinkLabel');
    copyBtn.addEventListener('click', function () {
        navigator.clipboard.writeText(shareUrl).then(function () {
            copyLabel.textContent = 'Copied!';
            setTimeout(function () {
                copyLabel.textContent = 'Copy link';
                closeMenu();
            }, 1200);
        });
    });
})();
</script>
