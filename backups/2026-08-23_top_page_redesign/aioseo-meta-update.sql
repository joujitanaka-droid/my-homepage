UPDATE wp_aioseo_posts
SET title = 'マシニング加工×ワイヤー放電加工｜精密金属加工のJPF',
    description = 'マシニング加工とワイヤー放電加工を組み合わせた精密金属加工。試作1個から量産まで、複雑形状・高精度加工・短納期案件に対応。京都の株式会社J・P・F。',
    updated = NOW()
WHERE post_id = 3435;

INSERT INTO wp_aioseo_posts (post_id, title, description, created, updated)
VALUES (3474, '図面を送って無料見積｜精密金属加工のJPF', '金属加工の見積依頼はこちらから。図面(DXF/PDF/STEP/IGES)を送るだけで、マシニング加工とワイヤー放電加工を組み合わせた最適な加工方法をご提案します。試作1個から量産まで対応。', NOW(), NOW());
