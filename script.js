document.addEventListener('DOMContentLoaded', function() {
    // スムーズスクロール機能
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // お問い合わせボタン
    const contactBtn = document.getElementById('contactBtn');
    
    if (contactBtn) {
        contactBtn.addEventListener('click', function() {
            // 外部問い合わせページにリダイレクト
            window.open('https://jp-factory.co.jp/contact/', '_blank');
        });
    }
});