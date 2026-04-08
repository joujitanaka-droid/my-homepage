# Domain Migration CSS Rules

このリポジトリでドメイン変更時にCSS崩れを防ぐための運用ルールです。

1. 絶対URLを使わない
- NG: https://jp-factory.co.jp/wp-content/...
- OK: /wp-content/...

2. 影響範囲を限定する
- `body.page-id-...` や専用クラスでスコープしてからスタイルを当てる。
- `img`, `a`, `h1` などの広域セレクタを直接上書きしない。

3. `!important` は最小限
- インラインstyle上書きなど、必要な箇所のみに限定する。

4. リニューアル時の適用順序
- 先に子テーマ `wp-content/themes/swell_child/style.css` を調整する。
- その後、HTMLのハードコードURLを相対化する。

5. 変更後チェック
- PC/SPで表示確認
- 主要ページ（トップ、SlowTH、問い合わせ）の画像・リンク切れ確認
- デプロイ後にキャッシュクリア
