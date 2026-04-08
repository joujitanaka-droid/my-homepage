# My Homepage

このプロジェクトは、シンプルなホームページを作成するためのサンプルです。

## ファイル構成

- `index.html`: ホームページのメインHTMLファイル。ページの構造やコンテンツを定義します。
- `styles.css`: ホームページのスタイルを定義するCSSファイル。フォント、色、レイアウトなどのスタイルが含まれます。
- `script.js`: ホームページの動的な機能を実装するJavaScriptファイル。ユーザーのインタラクションに応じた処理を行います。

## セットアップ手順

1. このリポジトリをクローンまたはダウンロードします。
2. `index.html`をブラウザで開きます。

## 使用方法

- ページを表示するには、`index.html`をブラウザで開いてください。
- スタイルやスクリプトを変更することで、ページの見た目や動作をカスタマイズできます。

## Xserver自動反映（GitHub Actions）

push時にXserverへ自動反映するワークフローを追加済みです。

対象ファイル:

- [.github/workflows/deploy-xserver.yml](.github/workflows/deploy-xserver.yml)

初回だけGitHubリポジトリの Settings で以下を設定してください。

Secrets（Repository secrets）:

- XSERVER_FTP_HOST
- XSERVER_FTP_USERNAME
- XSERVER_FTP_PASSWORD

Variables（Repository variables、任意）:

- XSERVER_FTP_PROTOCOL: ftp または ftps（未設定時は ftps）
- XSERVER_FTP_PORT: 21 など（未設定時は 21）
- XSERVER_SERVER_DIR: /public_html/ など（未設定時は /public_html/）

設定後は main への push ごとに自動デプロイされます。