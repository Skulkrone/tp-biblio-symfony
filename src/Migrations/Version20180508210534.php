<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180508210534 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adherents (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunts (id INT AUTO_INCREMENT NOT NULL, fklivre_id INT NOT NULL, fkadherents_id INT NOT NULL, date_emprunt DATETIME NOT NULL, date_retour DATETIME NOT NULL, INDEX IDX_38FC80DB3BEF99A (fklivre_id), INDEX IDX_38FC80D227D53CD (fkadherents_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunts ADD CONSTRAINT FK_38FC80DB3BEF99A FOREIGN KEY (fklivre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE emprunts ADD CONSTRAINT FK_38FC80D227D53CD FOREIGN KEY (fkadherents_id) REFERENCES adherents (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emprunts DROP FOREIGN KEY FK_38FC80D227D53CD');
        $this->addSql('ALTER TABLE emprunts DROP FOREIGN KEY FK_38FC80DB3BEF99A');
        $this->addSql('DROP TABLE adherents');
        $this->addSql('DROP TABLE emprunts');
        $this->addSql('DROP TABLE livre');
    }
}
