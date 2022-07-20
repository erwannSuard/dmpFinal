<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720112812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cost_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE distribution_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE embargo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE funding_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE host_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE licence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE metadata_info_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE research_output_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE romp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vocabulary_info_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) NOT NULL, affiliation VARCHAR(255) NOT NULL, laboratory_or_department VARCHAR(255) DEFAULT NULL, identifier TEXT DEFAULT NULL, role_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cost (id INT NOT NULL, funded_by_id INT DEFAULT NULL, research_output_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, unit VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_182694FC8B81BE4F ON cost (funded_by_id)');
        $this->addSql('CREATE INDEX IDX_182694FCA545A879 ON cost (research_output_id)');
        $this->addSql('CREATE TABLE data (id INT NOT NULL, research_output_id INT NOT NULL, sensitive_data BOOLEAN NOT NULL, personnal_data BOOLEAN NOT NULL, data_security TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADF3F363A545A879 ON data (research_output_id)');
        $this->addSql('CREATE TABLE distribution (id INT NOT NULL, embargo_id INT DEFAULT NULL, licence_id INT NOT NULL, host_id INT NOT NULL, size_unit TEXT CHECK (size_unit IN (\'Ko\', \'Mo\', \'Go\', \'To\', \'Po\')), access_url TEXT NOT NULL, access_protocol TEXT NOT NULL, size_value INT DEFAULT NULL, access TEXT CHECK (access IN (\'open default\', \'onDemand\', \'embargo\')), format TEXT DEFAULT NULL, download_url TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A448378151DADDC6 ON distribution (embargo_id)');
        $this->addSql('CREATE INDEX IDX_A448378126EF07C9 ON distribution (licence_id)');
        $this->addSql('CREATE INDEX IDX_A44837811FB8D185 ON distribution (host_id)');
        $this->addSql('CREATE TABLE embargo (id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, legal_and_contractual_reasons TEXT DEFAULT NULL, intentional_restrictions TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE funding (id INT NOT NULL, contact_id INT NOT NULL, grant_funding INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D30DD1D6E7A1254A ON funding (contact_id)');
        $this->addSql('CREATE TABLE host (id INT NOT NULL, host_name TEXT NOT NULL, host_description TEXT NOT NULL, host_url TEXT NOT NULL, certified_with TEXT DEFAULT NULL, pid_system TEXT DEFAULT NULL, support_versionning BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE licence (id INT NOT NULL, name TEXT NOT NULL, url TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE metadata_info (id INT NOT NULL, research_output_id INT NOT NULL, description TEXT NOT NULL, standard_name TEXT DEFAULT NULL, api TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_104B479EA545A879 ON metadata_info (research_output_id)');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, parent_project_id INT DEFAULT NULL, funding_general_info_id INT DEFAULT NULL, title TEXT NOT NULL, abstract TEXT NOT NULL, acronyme TEXT DEFAULT NULL, start_date DATE NOT NULL, duration INT DEFAULT NULL, website TEXT DEFAULT NULL, objectives TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE512E9BCC ON project (parent_project_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE4C700686 ON project (funding_general_info_id)');
        $this->addSql('CREATE TABLE project_contact (project_id INT NOT NULL, contact_id INT NOT NULL, PRIMARY KEY(project_id, contact_id))');
        $this->addSql('CREATE INDEX IDX_DA7CEA5D166D1F9C ON project_contact (project_id)');
        $this->addSql('CREATE INDEX IDX_DA7CEA5DE7A1254A ON project_contact (contact_id)');
        $this->addSql('CREATE TABLE research_output (id INT NOT NULL, romp_id INT NOT NULL, title TEXT NOT NULL, type TEXT NOT NULL, identifier TEXT DEFAULT NULL, description TEXT DEFAULT NULL, standard_used TEXT DEFAULT NULL, reused BOOLEAN NOT NULL, lineage TEXT DEFAULT NULL, issued DATE DEFAULT NULL, language TEXT NOT NULL, keyword TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B3FB49D8CA4ACB1 ON research_output (romp_id)');
        $this->addSql('COMMENT ON COLUMN research_output.keyword IS \'(DC2Type:simple_array)\'');
        $this->addSql('CREATE TABLE research_output_contact (research_output_id INT NOT NULL, contact_id INT NOT NULL, PRIMARY KEY(research_output_id, contact_id))');
        $this->addSql('CREATE INDEX IDX_435B3EF2A545A879 ON research_output_contact (research_output_id)');
        $this->addSql('CREATE INDEX IDX_435B3EF2E7A1254A ON research_output_contact (contact_id)');
        $this->addSql('CREATE TABLE research_output_research_output (research_output_source INT NOT NULL, research_output_target INT NOT NULL, PRIMARY KEY(research_output_source, research_output_target))');
        $this->addSql('CREATE INDEX IDX_B95063F466AB813A ON research_output_research_output (research_output_source)');
        $this->addSql('CREATE INDEX IDX_B95063F47F4ED1B5 ON research_output_research_output (research_output_target)');
        $this->addSql('CREATE TABLE romp (id INT NOT NULL, contact_id INT NOT NULL, project_id INT NOT NULL, identifier TEXT DEFAULT NULL, submission_date DATE NOT NULL, version TEXT NOT NULL, deliverable TEXT NOT NULL, licence TEXT CHECK (licence IN (\'CC-BY-4.0\', \'CC-BY-NC-4.0\', \'CC-BY--ND-4.0\', \'CC-BY--SA-4.0\', \'CC0-1.0\')), ethical_issues TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23AF5FC0E7A1254A ON romp (contact_id)');
        $this->addSql('CREATE INDEX IDX_23AF5FC0166D1F9C ON romp (project_id)');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, research_output_id INT NOT NULL, type_of_service TEXT NOT NULL, end_project_trl INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E19D9AD2A545A879 ON service (research_output_id)');
        $this->addSql('CREATE TABLE vocabulary_info (id INT NOT NULL, vocabulary_name TEXT DEFAULT NULL, uri TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE vocabulary_info_research_output (vocabulary_info_id INT NOT NULL, research_output_id INT NOT NULL, PRIMARY KEY(vocabulary_info_id, research_output_id))');
        $this->addSql('CREATE INDEX IDX_3B9EB4516A131780 ON vocabulary_info_research_output (vocabulary_info_id)');
        $this->addSql('CREATE INDEX IDX_3B9EB451A545A879 ON vocabulary_info_research_output (research_output_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE cost ADD CONSTRAINT FK_182694FC8B81BE4F FOREIGN KEY (funded_by_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cost ADD CONSTRAINT FK_182694FCA545A879 FOREIGN KEY (research_output_id) REFERENCES research_output (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE data ADD CONSTRAINT FK_ADF3F363A545A879 FOREIGN KEY (research_output_id) REFERENCES research_output (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A448378151DADDC6 FOREIGN KEY (embargo_id) REFERENCES embargo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A448378126EF07C9 FOREIGN KEY (licence_id) REFERENCES licence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A44837811FB8D185 FOREIGN KEY (host_id) REFERENCES host (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE funding ADD CONSTRAINT FK_D30DD1D6E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metadata_info ADD CONSTRAINT FK_104B479EA545A879 FOREIGN KEY (research_output_id) REFERENCES research_output (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE512E9BCC FOREIGN KEY (parent_project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE4C700686 FOREIGN KEY (funding_general_info_id) REFERENCES funding (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_contact ADD CONSTRAINT FK_DA7CEA5D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_contact ADD CONSTRAINT FK_DA7CEA5DE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE research_output ADD CONSTRAINT FK_6B3FB49D8CA4ACB1 FOREIGN KEY (romp_id) REFERENCES romp (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE research_output_contact ADD CONSTRAINT FK_435B3EF2A545A879 FOREIGN KEY (research_output_id) REFERENCES research_output (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE research_output_contact ADD CONSTRAINT FK_435B3EF2E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE research_output_research_output ADD CONSTRAINT FK_B95063F466AB813A FOREIGN KEY (research_output_source) REFERENCES research_output (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE research_output_research_output ADD CONSTRAINT FK_B95063F47F4ED1B5 FOREIGN KEY (research_output_target) REFERENCES research_output (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE romp ADD CONSTRAINT FK_23AF5FC0E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE romp ADD CONSTRAINT FK_23AF5FC0166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2A545A879 FOREIGN KEY (research_output_id) REFERENCES research_output (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vocabulary_info_research_output ADD CONSTRAINT FK_3B9EB4516A131780 FOREIGN KEY (vocabulary_info_id) REFERENCES vocabulary_info (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vocabulary_info_research_output ADD CONSTRAINT FK_3B9EB451A545A879 FOREIGN KEY (research_output_id) REFERENCES research_output (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cost DROP CONSTRAINT FK_182694FC8B81BE4F');
        $this->addSql('ALTER TABLE funding DROP CONSTRAINT FK_D30DD1D6E7A1254A');
        $this->addSql('ALTER TABLE project_contact DROP CONSTRAINT FK_DA7CEA5DE7A1254A');
        $this->addSql('ALTER TABLE research_output_contact DROP CONSTRAINT FK_435B3EF2E7A1254A');
        $this->addSql('ALTER TABLE romp DROP CONSTRAINT FK_23AF5FC0E7A1254A');
        $this->addSql('ALTER TABLE distribution DROP CONSTRAINT FK_A448378151DADDC6');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE4C700686');
        $this->addSql('ALTER TABLE distribution DROP CONSTRAINT FK_A44837811FB8D185');
        $this->addSql('ALTER TABLE distribution DROP CONSTRAINT FK_A448378126EF07C9');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE512E9BCC');
        $this->addSql('ALTER TABLE project_contact DROP CONSTRAINT FK_DA7CEA5D166D1F9C');
        $this->addSql('ALTER TABLE romp DROP CONSTRAINT FK_23AF5FC0166D1F9C');
        $this->addSql('ALTER TABLE cost DROP CONSTRAINT FK_182694FCA545A879');
        $this->addSql('ALTER TABLE data DROP CONSTRAINT FK_ADF3F363A545A879');
        $this->addSql('ALTER TABLE metadata_info DROP CONSTRAINT FK_104B479EA545A879');
        $this->addSql('ALTER TABLE research_output_contact DROP CONSTRAINT FK_435B3EF2A545A879');
        $this->addSql('ALTER TABLE research_output_research_output DROP CONSTRAINT FK_B95063F466AB813A');
        $this->addSql('ALTER TABLE research_output_research_output DROP CONSTRAINT FK_B95063F47F4ED1B5');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD2A545A879');
        $this->addSql('ALTER TABLE vocabulary_info_research_output DROP CONSTRAINT FK_3B9EB451A545A879');
        $this->addSql('ALTER TABLE research_output DROP CONSTRAINT FK_6B3FB49D8CA4ACB1');
        $this->addSql('ALTER TABLE vocabulary_info_research_output DROP CONSTRAINT FK_3B9EB4516A131780');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cost_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE data_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE distribution_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE embargo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE funding_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE host_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE licence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE metadata_info_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE research_output_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE romp_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vocabulary_info_id_seq CASCADE');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE cost');
        $this->addSql('DROP TABLE data');
        $this->addSql('DROP TABLE distribution');
        $this->addSql('DROP TABLE embargo');
        $this->addSql('DROP TABLE funding');
        $this->addSql('DROP TABLE host');
        $this->addSql('DROP TABLE licence');
        $this->addSql('DROP TABLE metadata_info');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_contact');
        $this->addSql('DROP TABLE research_output');
        $this->addSql('DROP TABLE research_output_contact');
        $this->addSql('DROP TABLE research_output_research_output');
        $this->addSql('DROP TABLE romp');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE vocabulary_info');
        $this->addSql('DROP TABLE vocabulary_info_research_output');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
