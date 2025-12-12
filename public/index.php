<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/bootstrap.php';

use toubeelib\praticien\Domaine\Entity\Specialite;
use toubeelib\praticien\Domaine\Entity\Praticien;
use toubeelib\praticien\Domaine\Entity\Structure;
use Doctrine\Common\Collections\Criteria;

$specialiteRepository = $entityManager->getRepository(Specialite::class);
$praticienRepository = $entityManager->getRepository(Praticien::class);
$structureRepository = $entityManager->getRepository(Structure::class);

echo "Excercice 1 <br>";
echo "1) <br>";
$specialiteID1 = $specialiteRepository->find(1);
if ($specialiteID1) {
    echo "ID: " . $specialiteID1->getId() . "<br>";
    echo "Libellé: " . $specialiteID1->getLibelle() . "<br>";
    echo "Description: " . $specialiteID1->getDescription() . "<br>";
} else {
    echo "Spécialité avec l'ID 1 non trouvée.";
}

echo "<br>2) <br>";
$praticien = $praticienRepository->find('8ae1400f-d46d-3b50-b356-269f776be532');
if ($praticien) {
    echo "ID: " . $praticien->getId() . "<br>";
    echo "Nom: " . $praticien->getNom() . "<br>";
    echo "Prénom: " . $praticien->getPrenom() . "<br>";
    echo "Ville: " . $praticien->getVille() . "<br>";
    echo "Email: " . $praticien->getEmail() . "<br>";
    echo "Téléphone: " . $praticien->getTelephone() . "<br>";
} else {
    echo "Praticien non trouvé.";
}

echo "<br>3) <br>";
if ($praticien) {
    echo "Spécialité: " . $praticien->getSpecialite()->getLibelle() . "<br>";
    if ($praticien->getStructure()) {
        echo "Structure: " . $praticien->getStructure()->getNom() . "<br>";
        echo "Adresse: " . $praticien->getStructure()->getAdresse() . "<br>";
    } else {
        echo "Pas de structure de rattachement<br>";
    }
}

echo "<br>4) <br>";
$structure = $structureRepository->find('3444bdd2-8783-3aed-9a5e-4d298d2a2d7c');
if ($structure) {
    echo "Structure: " . $structure->getNom() . "<br>";
    echo "Adresse: " . $structure->getAdresse() . "<br>";
    echo "Ville: " . $structure->getVille() . "<br>";
    echo "<br>Liste des praticiens:<br>";
    foreach ($structure->getPraticiens() as $prat) {
        echo "- " . $prat->getNom() . " " . $prat->getPrenom() . " (" . $prat->getSpecialite()->getLibelle() . ")<br>";
    }
} else {
    echo "Structure non trouvée.";
}

echo "<br>5) <br>";
if ($specialiteID1) {
    echo "Spécialité: " . $specialiteID1->getLibelle() . "<br>";
    echo "Description: " . $specialiteID1->getDescription() . "<br>";
    echo "<br>Motifs de visite associés:<br>";
    foreach ($specialiteID1->getMotifs() as $motif) {
        echo "- " . $motif->getLibelle() . "<br>";
    }
}

echo "<br>6) <br>";
if ($praticien) {
    echo "Praticien: " . $praticien->getNom() . " " . $praticien->getPrenom() . "<br>";
    echo "<br>Motifs de visite:<br>";
    foreach ($praticien->getMotifs() as $motif) {
        echo "- " . $motif->getLibelle() . "<br>";
    }
}

echo "<br>7) <br>";
$pediatrie = $specialiteRepository->findOneBy(['libelle' => 'pédiatrie']);
if ($pediatrie) {
    $nouveauPraticien = new Praticien(
        "HAHA",
        "Wiwi",
        "Nancy",
        "wiwi.haha@example.com",
        "0383123456"
    );
    $nouveauPraticien->setId(\Ramsey\Uuid\Uuid::uuid4()->toString());
    $nouveauPraticien->setSpecialite($pediatrie);
    
    $entityManager->persist($nouveauPraticien);
    $entityManager->flush();
    
    echo "Praticien créé: " . $nouveauPraticien->getNom() . " " . $nouveauPraticien->getPrenom() . "<br>";
    echo "ID: " . $nouveauPraticien->getId() . "<br>";
    echo "Spécialité: " . $nouveauPraticien->getSpecialite()->getLibelle() . "<br>";
} else {
    echo "Spécialité pédiatrie non trouvée.";
}

echo "<br>8) <br>";
if (isset($nouveauPraticien)) {
    $structure = $structureRepository->findOneBy(['nom' => 'Cabinet Bigot']);
    if ($structure) {
        $nouveauPraticien->setStructure($structure);
    }
    
    $nouveauPraticien->setVille("Paris");
    
    $motifRepository = $entityManager->getRepository(\toubeelib\praticien\Domaine\Entity\MotifVisite::class);
    $motif1 = $motifRepository->find(1);
    $motif2 = $motifRepository->find(2);
    if ($motif1) $nouveauPraticien->addMotif($motif1);
    if ($motif2) $nouveauPraticien->addMotif($motif2);
    
    $entityManager->flush();
    
    echo "Praticien modifié: " . $nouveauPraticien->getNom() . " " . $nouveauPraticien->getPrenom() . "<br>";
    echo "Ville: " . $nouveauPraticien->getVille() . "<br>";
    if ($nouveauPraticien->getStructure()) {
        echo "Structure: " . $nouveauPraticien->getStructure()->getNom() . "<br>";
    }
    echo "Motifs: ";
    foreach ($nouveauPraticien->getMotifs() as $mot) {
        echo $mot->getLibelle() . ", ";
    }
    echo "<br>";
}

echo "<br>9) <br>";
if (isset($nouveauPraticien)) {
    $nomPraticien = $nouveauPraticien->getNom() . " " . $nouveauPraticien->getPrenom();
    
    $entityManager->remove($nouveauPraticien);
    $entityManager->flush();
    
    echo "Praticien supprimé: " . $nomPraticien . "<br>";
}

echo "<h2>Exercice 2</h2>";

echo "<br>1) <br>";
$praticienEmail = $praticienRepository->findOneBy(['email' => 'Gabrielle.Klein@live.com']);
if ($praticienEmail) {
    echo "Praticien: " . $praticienEmail->getNom() . " " . $praticienEmail->getPrenom() . "<br>";
    echo "Email: " . $praticienEmail->getEmail() . "<br>";
    echo "Ville: " . $praticienEmail->getVille() . "<br>";
    echo "Téléphone: " . $praticienEmail->getTelephone() . "<br>";
} else {
    echo "Praticien non trouvé.";
}

echo "<br>2) <br>";
$praticienGoncalves = $praticienRepository->findOneBy(['nom' => 'Goncalves', 'ville' => 'Paris']);
if ($praticienGoncalves) {
    echo "Praticien: " . $praticienGoncalves->getNom() . " " . $praticienGoncalves->getPrenom() . "<br>";
    echo "Ville: " . $praticienGoncalves->getVille() . "<br>";
    echo "Email: " . $praticienGoncalves->getEmail() . "<br>";
} else {
    echo "Praticien non trouvé.";
}

echo "<br>3) <br>";
$specialitePediatrie = $specialiteRepository->findOneBy(['libelle' => 'pédiatrie']);
if ($specialitePediatrie) {
    echo "Spécialité: " . $specialitePediatrie->getLibelle() . "<br>";
    echo "Description: " . $specialitePediatrie->getDescription() . "<br>";
    echo "<br>Praticiens associés:<br>";
    
    $praticiensPediatrie = $praticienRepository->findBy(['specialite' => $specialitePediatrie]);
    foreach ($praticiensPediatrie as $pp) {
        echo "- " . $pp->getNom() . " " . $pp->getPrenom() . " (" . $pp->getVille() . ")<br>";
    }
} else {
    echo "Spécialité non trouvée.";
}

echo "<br>4) <br>";
$specialites = $specialiteRepository->matching(
    Criteria::create()
        ->where(Criteria::expr()->contains('description', 'santé'))
        ->orderBy(['libelle' => 'ASC'])
);
echo "Spécialités contenant 'santé' dans la description:<br>";
foreach ($specialites as $spec) {
    echo "- " . $spec->getLibelle() . " : " . $spec->getDescription() . "<br>";
}

echo "<br>5) <br>";
$specialiteOphtalmo = $specialiteRepository->findOneBy(['libelle' => 'ophtalmologie']);
if ($specialiteOphtalmo) {
    $praticiensOphtalmo = $praticienRepository->matching(
        Criteria::create()
            ->where(Criteria::expr()->eq('specialite', $specialiteOphtalmo))
            ->andWhere(Criteria::expr()->eq('ville', 'Paris'))
            ->orderBy(['nom' => 'ASC'])
    );
    echo "Praticiens en ophtalmologie à Paris:<br>";
    foreach ($praticiensOphtalmo as $po) {
        echo "- " . $po->getNom() . " " . $po->getPrenom() . "<br>";
    }
} else {
    echo "Spécialité ophtalmologie non trouvée.";
}