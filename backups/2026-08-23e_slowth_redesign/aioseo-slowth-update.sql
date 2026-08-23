UPDATE wp_aioseo_posts
SET title = 'マシニング自動化・夜間無人運転｜AIロボット SlowTH',
    description = 'SlowTHは、協働ロボット・カメラ・AI制御を組み合わせたマシニング加工現場向け自動化システム。材料供給・扉開閉・ワーク交換・取り出し・整列などを自動化し、夜間無人運転を目指します。株式会社J・P・F。',
    updated = NOW()
WHERE post_id = 3337;

INSERT INTO wp_aioseo_posts (post_id, title, description, created, updated)
VALUES (3515, 'SlowTH 導入相談・デモ依頼｜AIロボット SlowTH', 'マシニング加工現場の自動化についての導入相談・現場確認・デモ依頼はこちらから。使用中の加工機や自動化したい作業をお聞かせください。株式会社J・P・F。', NOW(), NOW());
