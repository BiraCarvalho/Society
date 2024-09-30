<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240930094659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // 1. Dropar a tabela user se existir
        $this->addSql("DROP TABLE IF EXISTS \"user\"");

        // 2. Criar a tabela user novamente com o campo id como SERIAL
        $this->addSql("
            CREATE TABLE \"user\" (
                id SERIAL PRIMARY KEY,
                username VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                roles TEXT[] NOT NULL DEFAULT '{}'
            )
        ");

        $this->addSql("
            INSERT
            INTO \"user\" (username, password, roles)
            VALUES ('admin', '\$2y\$10\$BjMbHh46PUe9pje3KueOJe/AT4CqmP3ypHGw5x1G3Hj05tFBl.q3Croot@779039ed7dec', '{}'
            )"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE IF EXISTS \"user\"");
    }
}
