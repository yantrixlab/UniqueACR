const { chromium } = require('playwright');

(async () => {
    const browser = await chromium.launch();
    const page = await browser.newPage({ viewport: { width: 1920, height: 1080 } });

    page.on('response', async (res) => {
        if (res.status() >= 400) {
            let body = '';
            try { body = (await res.text()).slice(0, 1500); } catch (e) {}
            console.log('FAILED RESPONSE:', res.status(), res.url());
            console.log(body);
        }
    });

    await page.goto('http://127.0.0.1:8145/admin/login');
    await page.fill('input[type="email"]', 'playwright-temp-test@example.com');
    await page.fill('input[type="password"]', 'TempPass12345!');
    await page.click('button[type="submit"]');
    await page.waitForURL('**/admin', { timeout: 15000 });

    const response = await page.goto('http://127.0.0.1:8145/admin/blog-posts/1/edit');
    console.log('STATUS:', response.status());
    await page.waitForTimeout(2000);

    const seoText = await page.evaluate(() => {
        const panel = document.querySelector('.seo-insights-panel');
        return panel ? panel.innerText.slice(0, 300) : 'SEO PANEL NOT FOUND';
    });
    console.log('SEO PANEL TEXT:', seoText);

    await page.screenshot({ path: 'pw-crash-fix.png', fullPage: true });
    await browser.close();
})();
