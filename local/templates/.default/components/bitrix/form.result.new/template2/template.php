<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<div class="contact-form">
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<div class="contact-form__head">
		<?
if ($arResult["isFormTitle"])
{
?>
	<div class="contact-form__head-title"><?=$arResult["FORM_TITLE"]?></div>
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<div class="contact-form__head-text"><?=$arResult["FORM_DESCRIPTION"]?></div>

	</div>
	<?
} // endif
	?>
<br />
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>

				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>


	<div class="contact-form__form-inputs"> 
	<?php foreach($arQuestion['STRUCTURE'] as $k=> $v):?>

		<div class="input contact-form__input"><label class="input__label" for="<?= $v['FIELD_ID']?>">
			<div class="input__label-text"><?= $v['MESSAGE'];?>*</div>
				<?php if($v['FIELD_TYPE']=='textarea'):?>
					<textarea class="input__input" type="text" id="<?= $v['FIELD_ID']?>" name="form_<?= $v['FIELD_TYPE'];?>_<?= $v['ID']?>"
                          value="<?= $v['VALUE'];?> "></textarea>
			    <?php else:?>
                <input class="input__input" type="<?=$v['FIELD_TYPE'];?>" id="<?= $v['FIELD_ID']?>" name="form_<?= $v['FIELD_TYPE'];?>_<?= $v['ID']?>" value="<?= $v['VALUE'];?>"
                       required="">
				<?php endif;?>

            </label></div>

	<?php endforeach;?>
	<?
		}
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>

			<b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b>


			<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />

			<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
			<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />

<?
} // isUseCaptcha
?>

<div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">Нажимая "Отправить", Вы подтверждаете, что
                ознакомлены, полностью согласны и принимаете условия "Согласия на обработку персональных
                данных";.
            </div>
				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
				<button style="margin: 0; padding: 0;"  name="web_form_submit"  class="form-button contact-form__bottom-button" data-success="Отправлено" data-error="Ошибка отправки">
					<div class="form-button__title" ><input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> style="border: 1px solid rgba(0, 0, 0, 0.2);" class="form-button__title"  type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" /></div>
            </button>

		</div>
<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
	</div>
</div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
