-- Green Market image path migration
-- Run this after renaming the files in assets/images.
-- It updates existing database rows to the camelCase asset paths used by the code.

SET NAMES utf8mb4;
START TRANSACTION;

-- Category images renamed from accented/spaced filenames.
UPDATE `categorie`
SET `Categ_img` = CASE `Categ_img`
  WHEN 'assets/images/categories/Cosmétiques.png.jpeg' THEN 'assets/images/categories/cosmetiques.jpeg'
  WHEN 'assets/images/categories/Cosm#U00e9tiques.png.jpeg' THEN 'assets/images/categories/cosmetiques.jpeg'
  WHEN 'assets/images/categories/mode traditionnel.jpeg' THEN 'assets/images/categories/modeTraditionnel.jpeg'
  WHEN 'assets/images/categories/prodiuts bio.jpeg' THEN 'assets/images/categories/produitsBio.jpeg'
  WHEN 'assets/images/categories/green market.png.png' THEN 'assets/images/categories/greenMarket.png'
  ELSE `Categ_img`
END;

-- Main product images renamed to camelCase.
UPDATE `produit`
SET `Prod_img` = CASE `Prod_img`
  WHEN 'assets/images/products/Savon beldi.png' THEN 'assets/images/products/savonBeldi.png'
  WHEN 'assets/images/products/Huile d''Argan Bio.png' THEN 'assets/images/products/huileArganBio.png'
  WHEN 'assets/images/products/Huile d''Olive Vierge.png' THEN 'assets/images/products/huileOliveVierge.png'
  WHEN 'assets/images/products/Tapis Azilal Indigo.png' THEN 'assets/images/products/tapisAzilalIndigo.png'
  WHEN 'assets/images/products/Tagine Terracotta.png' THEN 'assets/images/products/tagineTerracotta.png'
  WHEN 'assets/images/products/Kaftan Bleu Indigo.png' THEN 'assets/images/products/kaftanBleuIndigo.png'
  WHEN 'assets/images/product-details/aime img/RoseWater.jpg' THEN 'assets/images/product-details/aimeImg/RoseWater.jpg'
  WHEN 'assets/images/product-details/Argan_oil/AO_cosmetics.jpg' THEN 'assets/images/product-details/arganOil/arganOilCosmetics.jpg'
  ELSE `Prod_img`
END;

-- Product gallery images renamed to camelCase.
UPDATE `produit_image`
SET `image_path` = CASE `image_path`
  WHEN 'assets/images/product-details/Savon_beldi/Savon beldi.png' THEN 'assets/images/product-details/savonBeldi/savonBeldi.png'
  WHEN 'assets/images/product-details/Savon_beldi/savonBeldi.png' THEN 'assets/images/product-details/savonBeldi/savonBeldi.png'
  WHEN 'assets/images/product-details/Savon_beldi/SB_akarFasi.jpeg' THEN 'assets/images/product-details/savonBeldi/savonBeldiAkarFasi.jpeg'
  WHEN 'assets/images/product-details/Savon_beldi/SB_flowers.jpeg' THEN 'assets/images/product-details/savonBeldi/savonBeldiFlowers.jpeg'
  WHEN 'assets/images/product-details/Savon_beldi/SB_herbs.jpeg' THEN 'assets/images/product-details/savonBeldi/savonBeldiHerbs.jpeg'
  WHEN 'assets/images/product-details/Savon_beldi/SB_nila.jpeg' THEN 'assets/images/product-details/savonBeldi/savonBeldiNila.jpeg'
  WHEN 'assets/images/product-details/Savon_beldi/SB_souffre.jpeg' THEN 'assets/images/product-details/savonBeldi/savonBeldiSouffre.jpeg'
  WHEN 'assets/images/product-details/Argan_oil/Huile d''Argan Bio.png' THEN 'assets/images/product-details/arganOil/huileArganBio.png'
  WHEN 'assets/images/product-details/Argan_oil/huileArganBio.png' THEN 'assets/images/product-details/arganOil/huileArganBio.png'
  WHEN 'assets/images/product-details/Argan_oil/AO_cosmetics.jpg' THEN 'assets/images/product-details/arganOil/arganOilCosmetics.jpg'
  WHEN 'assets/images/product-details/Tapis AI/Tapis Azilal Indigo.png' THEN 'assets/images/product-details/tapisAI/tapisAzilalIndigo.png'
  WHEN 'assets/images/product-details/tapisAI/Tapis Azilal Indigo.png' THEN 'assets/images/product-details/tapisAI/tapisAzilalIndigo.png'
  WHEN 'assets/images/product-details/tapisAI/TAI_ALL.jpg' THEN 'assets/images/product-details/tapisAI/tapisAzilalAll.jpg'
  WHEN 'assets/images/product-details/tapisAI/TAI_Details.jpg' THEN 'assets/images/product-details/tapisAI/tapisAzilalDetails.jpg'
  WHEN 'assets/images/product-details/Olive_oil/Huile d''Olive Vierge.png' THEN 'assets/images/product-details/oliveOil/huileOliveVierge.png'
  WHEN 'assets/images/product-details/Olive_oil/huileOliveVierge.png' THEN 'assets/images/product-details/oliveOil/huileOliveVierge.png'
  WHEN 'assets/images/product-details/Olive_oil/OH_bottle.jpeg' THEN 'assets/images/product-details/oliveOil/oliveOilBottle.jpeg'
  WHEN 'assets/images/product-details/Tagine Terracotta/Tagine Terracotta.png' THEN 'assets/images/product-details/tagineTerracotta/tagineTerracotta.png'
  WHEN 'assets/images/product-details/tagineTerracotta/Tagine Terracotta.png' THEN 'assets/images/product-details/tagineTerracotta/tagineTerracotta.png'
  WHEN 'assets/images/product-details/tagineTerracotta/TT-Inside.jpg' THEN 'assets/images/product-details/tagineTerracotta/tagineTerracottaInside.jpg'
  WHEN 'assets/images/product-details/tagineTerracotta/TT_Details.jpg' THEN 'assets/images/product-details/tagineTerracotta/tagineTerracottaDetails.jpg'
  WHEN 'assets/images/product-details/tagineTerracotta/TT-Size.jpg' THEN 'assets/images/product-details/tagineTerracotta/tagineTerracottaSize.jpg'
  WHEN 'assets/images/product-details/kaftan/Kaftan Bleu Indigo.png' THEN 'assets/images/product-details/kaftan/kaftanBleuIndigo.png'
  WHEN 'assets/images/product-details/kaftan/KBI.jpeg' THEN 'assets/images/product-details/kaftan/kaftanBleuIndigoMain.jpeg'
  WHEN 'assets/images/product-details/kaftan/KBI1.jpeg' THEN 'assets/images/product-details/kaftan/kaftanBleuIndigoFront.jpeg'
  WHEN 'assets/images/product-details/kaftan/KBI_back.jpeg' THEN 'assets/images/product-details/kaftan/kaftanBleuIndigoBack.jpeg'
  WHEN 'assets/images/product-details/kaftan/KBI_style.jpeg' THEN 'assets/images/product-details/kaftan/kaftanBleuIndigoStyle.jpeg'
  ELSE `image_path`
END;

-- Traceability images renamed to camelCase.
UPDATE `traceabilite`
SET `image_path` = CASE `image_path`
  WHEN 'assets/images/product-details/Tracabilite_step/step-1.png' THEN 'assets/images/product-details/tracabiliteStep/traceabiliteStep1.png'
  WHEN 'assets/images/product-details/Tracabilite_step/step_2.jpeg' THEN 'assets/images/product-details/tracabiliteStep/traceabiliteStep2.jpeg'
  WHEN 'assets/images/product-details/Tracabilite_step/step_3.jpeg' THEN 'assets/images/product-details/tracabiliteStep/traceabiliteStep3.jpeg'
  WHEN 'assets/images/product-details/Tracabilite_step/step-4.jpeg' THEN 'assets/images/product-details/tracabiliteStep/traceabiliteStep4.jpeg'
  ELSE `image_path`
END;

COMMIT;
