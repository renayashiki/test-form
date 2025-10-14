# お問い合わせフォーム

Dockerビルド
1. git clone git@github.com:renayashiki/test-form.git

2. docker-compose up -d --build


## 環境構築

1. docker-compose exec php bash
2. composer install
3. .env.example から .env を作成し、環境変数を設定
4. php artisan key:generate
5. php artisan migrate --seed
6. php artisan db:seed

## 備考
管理者のログイン情報

admin@example.com
このメールアドレスでログイン
password:   password
パスワードは 'password'でログイン
---

## 使用技術（実行環境）
- PHP 8.2
- Laravel 10.x
- MySQL 8.0.26
- Nginx 1.21.1
- Docker / Docker Compose 3.9（Compose仕様）

---

## ER図

![ER Diagram](public/images/er_diagram.drawio.svg)

---

### ER図構成

#### usersテーブル
| カラム名 | 型 | 説明 |
|-----------|------|------|
| id | bigint | ユーザーID（主キー） |
| name | string | ユーザー名 |
| email | string | メールアドレス（ユニーク） |
| password | string | パスワード（ハッシュ） |
| is_admin | boolean | 管理者フラグ |
| created_at / updated_at | timestamp | 登録・更新日時 |

#### contactsテーブル
| カラム名 | 型 | 説明 |
|-----------|------|------|
| id | bigint | お問い合わせID（主キー） |
| user_id | bigint | 外部キー（users.id） |
| title | string | 件名 |
| message | text | お問い合わせ内容 |
| created_at / updated_at | timestamp | 登録・更新日時 |

#### categoriesテーブル
| カラム名 | 型 | 説明 |
|-----------|------|------|
| id | bigint | カテゴリID（主キー） |
| name | string | カテゴリ名 |
| created_at / updated_at | timestamp | 登録・更新日時 |

#### contact_categoryテーブル（中間テーブル）
| カラム名 | 型 | 説明 |
|-----------|------|------|
| id | bigint | ID（主キー） |
| contact_id | bigint | 外部キー（contacts.id） |
| category_id | bigint | 外部キー（categories.id） |

---

### リレーション関係
- users（1）ー（∞）contacts
- ※ 1人のユーザーは複数の問い合わせを作成できます。
- categories（1）ー（∞）contacts
- ※ 1つのカテゴリは複数の問い合わせに紐づきます。

---

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/



