<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304224716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, author, is_borrowed, borrow_date, return_date FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, is_borrowed BOOLEAN NOT NULL, borrow_date DATETIME DEFAULT NULL, return_date DATETIME DEFAULT NULL, category VARCHAR(100) NOT NULL)');
        $this->addSql('INSERT INTO book (id, title, author, is_borrowed, borrow_date, return_date) SELECT id, title, author, is_borrowed, borrow_date, return_date FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, author, is_borrowed, borrow_date, return_date FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, is_borrowed BOOLEAN NOT NULL, borrow_date DATETIME DEFAULT NULL, return_date DATETIME DEFAULT NULL, return_deadline DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO book (id, title, author, is_borrowed, borrow_date, return_date) SELECT id, title, author, is_borrowed, borrow_date, return_date FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }
}
