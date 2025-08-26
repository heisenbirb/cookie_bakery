// admin_actions.js
const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch({
        headless: false, // Set to true for production, false for debugging
        args: ['--no-sandbox', '--disable-setuid-sandbox'],
        slowMo: 50,
    });
    const page = await browser.newPage();

    // Navigate directly to the login page
    await page.goto('http://localhost:8000/login.php');

    // Type credentials
    await page.type('input[name="username"]', 'admin');
    await page.type('input[name="password"]', 'highentropy');

    // Click login and wait for the navigation to the forum page
    await Promise.all([
        page.click('input[type="submit"]'),
        page.waitForNavigation({ waitUntil: 'networkidle0' }),
    ]);

    // Now, the page should already be on forum.php.
    // At this point, the XSS payload will execute.

    // Optional: Take a screenshot to confirm you're on the right page
    await page.screenshot({ path: 'logged_in.png' });

    console.log('Admin bot successfully logged in and visited the forum.');

    await browser.close();
})();