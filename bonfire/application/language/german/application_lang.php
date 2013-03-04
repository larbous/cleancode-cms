<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	Copyright (c) 2011 Lonnie Ezell

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

//--------------------------------------------------------------------
// ! GENERAL SETTINGS
//--------------------------------------------------------------------

$lang['bf_site_name'] = 'Seitenname';
$lang['bf_site_email'] = 'Administrator E-Mail';
$lang['bf_site_email_help'] = 'Dieses System verschickt Systemgenerierte E-Mails';
$lang['bf_site_status'] = 'Seitenstatus';
$lang['bf_online'] = 'Online';
$lang['bf_offline'] = 'Offline';
$lang['bf_top_number'] = 'Items <em>pro</em> Seite:';
$lang['bf_top_number_help'] = 'Wie wievele Items sollen angezeigt werden wenn Sie Berichte ziehen';
$lang['bf_home'] = 'Home';
$lang['bf_site_information'] = 'Seiteninformation';
$lang['bf_timezone'] = 'Zeitzone';
$lang['bf_language'] = 'Sprache';
$lang['bf_language_help'] = 'Welche Sprache soll für Anwender verfügbar sein';

//--------------------------------------------------------------------
// ! AUTH SETTINGS
//--------------------------------------------------------------------

$lang['bf_security'] = 'Sicherheit';
$lang['bf_login_type'] = 'Login Typ';
$lang['bf_login_type_email'] = 'nur E-Mail';
$lang['bf_login_type_username'] = 'nur Benutzernamen';
$lang['bf_allow_register'] = 'Registrierung erlauben';
$lang['bf_login_type_both'] = 'E-Mail oder Benutzernamen';
$lang['bf_use_usernames'] = 'Bentzer in Bonfire anzeigen:';
$lang['bf_use_own_name'] = 'eigenen Namen benutzen';
$lang['bf_allow_remember'] = '\'Remember Me\' erlauben?';
$lang['bf_remember_time'] = 'Angemeldetter Benutzer für';
$lang['bf_week'] = 'Woche';
$lang['bf_weeks'] = 'Wochen';
$lang['bf_days'] = 'Tage';
$lang['bf_username'] = 'Benutzername';
$lang['bf_password'] = 'Paßwort';
$lang['bf_password_confirm'] = 'Paßwort (wiederholen)';
$lang['bf_display_name'] = 'Anzeigename';

//--------------------------------------------------------------------
// ! CRUD SETTINGS
//--------------------------------------------------------------------

$lang['bf_home_page'] = 'Homepage';
$lang['bf_pages'] = 'Seiten';
$lang['bf_enable_rte'] = 'RNL lesen für Seiten erlauben?';
$lang['bf_rte_type'] = 'RNL Type';
$lang['bf_searchable_default'] = 'Standardmäßig suchbar?';
$lang['bf_cacheable_default'] = 'Standardmäßig Cachebar';
$lang['bf_track_hits'] = 'PageHits verfolgen';
$lang['bf_action_save'] = 'Speichern';
$lang['bf_action_delete'] = 'Löschen';
$lang['bf_action_cancel'] = 'Abbrechen';
$lang['bf_action_download'] = 'Herunterladen';
$lang['bf_action_preview'] = 'Vorschau';
$lang['bf_action_search'] = 'Suche';
$lang['bf_action_purge'] = 'Säubern';
$lang['bf_action_restore'] = 'Wiederherstellen';
$lang['bf_action_show'] = 'Anzeigen';
$lang['bf_action_login'] = 'Login';
$lang['bf_action_logout'] = 'Logout';
$lang['bf_actions'] = 'Aktionen';
$lang['bf_clear'] = 'Leeren';
$lang['bf_action_list'] = 'List';
$lang['bf_action_create'] = 'Erstellen';
$lang['bf_action_ban'] = 'Bannen';

//--------------------------------------------------------------------
// ! SETTINGS LIB
//--------------------------------------------------------------------

$lang['bf_do_check'] = 'Auf Updates prüfen?';
$lang['bf_do_check_edge'] = 'Muss aktiviert werden, damit bleeding edge Updates zu sehen sind.';
$lang['bf_update_show_edge'] = 'bleeding edge updates anzeigen';
$lang['bf_update_info_edge'] = 'Deaktiviert lassen, um nur neue getaggt Updates zu suchen. Aktiviren um alle neue Commits im offiziellen Repository zu sehen.';
$lang['bf_ext_profile_show'] = 'Hat der Benutzeraccount ein erweitertes Profil?';
$lang['bf_ext_profile_info'] = '"Extended Profiles" aktivieren um extra profile meta-data verfügbar zu haben, oder um Bonfire Defaultfelder zu entfernen.';
$lang['bf_yes'] = 'Ja';
$lang['bf_no'] = 'Nein';
$lang['bf_none'] = 'Nichts';
$lang['bf_id'] = 'ID';
$lang['bf_or'] = 'oder';
$lang['bf_size'] = 'Größe';
$lang['bf_files'] = 'Dateien';
$lang['bf_file'] = 'Datei';
$lang['bf_with_selected'] = 'mit ausgewählten';
$lang['bf_env_dev'] = 'Entwicklung';
$lang['bf_env_test'] = 'Testen';
$lang['bf_env_prod'] = 'Produktion';
$lang['bf_show_profiler'] = 'Admin Profil anzeigen?';
$lang['bf_show_front_profiler'] = 'ZeigeFront End Profiler?';
$lang['bf_cache_not_writable'] = 'Das Cacheverzeichnis hat keine Schreibrechte';
$lang['bf_password_strength'] = 'Einstellungen Paßwortstärke';
$lang['bf_password_length_help'] = 'Minimale Kennwortlänge z.B. 8';
$lang['bf_password_force_numbers'] = 'Soll das Paßwort zahlen enthalten?';
$lang['bf_password_force_symbols'] = 'Soll das paßewort Sympolde oder Sonderzeichen enthalten?';
$lang['bf_password_force_mixed_case'] = 'Soll das Paßwort Groß- und Kleinschreibung enthalten?';
$lang['bf_password_show_labels'] = 'Paßwortvalidierung anzeigen?';

//--------------------------------------------------------------------
// ! USER/PROFILE
//--------------------------------------------------------------------

$lang['bf_user'] = 'Benutzer';
$lang['bf_users'] = 'Benutzer';
$lang['bf_description'] = 'Beschreibung';
$lang['bf_email'] = 'E-Mail';
$lang['bf_user_settings'] = 'Mein Profil';

//--------------------------------------------------------------------
// !
//--------------------------------------------------------------------

$lang['bf_both'] = 'beides';
$lang['bf_go_back'] = 'Zurück';
$lang['bf_new'] = 'Neu';
$lang['bf_required_note'] = 'Benötigte Felder in <b>fett</b>.darstellen';
$lang['bf_form_label_required'] = '<span class="required">*</span>';

//--------------------------------------------------------------------
// MY_Model
//--------------------------------------------------------------------

$lang['bf_model_db_error'] = 'DB Error: ';
$lang['bf_model_no_data'] = 'Keine Daten verfügbar';
$lang['bf_model_invalid_id'] = 'Invalide ID an Model übergeben';
$lang['bf_model_no_table'] = 'Model hat undefinierte Datenbanktabelle ';
$lang['bf_model_fetch_error'] = 'Nicht genügend Informationen um das Feld zu finden';
$lang['bf_model_count_error'] = 'Nicht genug Informationen um das Ergebnis zu zählen';
$lang['bf_model_unique_error'] = 'Nicht genug Informationen um Einzigartigkeit zu testen';
$lang['bf_model_find_error'] = 'Nicht genügend Informationen, um von zu finden.';
$lang['bf_model_bad_select'] = 'Ungültige Auswahl.';

//--------------------------------------------------------------------
// Contexts
//--------------------------------------------------------------------

$lang['bf_no_contexts'] = 'Der Kontext ist nicht im Array eingerichtet. Überprüfen Sie Ihre Anwendungskonfiguration.';
$lang['bf_context_content'] = 'Content';
$lang['bf_context_reports'] = 'Berichte';
$lang['bf_context_settings'] = 'Einstellungen';
$lang['bf_context_developer'] = 'Entwickler';

//--------------------------------------------------------------------
// Activities
//--------------------------------------------------------------------
$lang['bf_act_settings_saved'] = 'App Einstellungen gespeichert';
$lang['bf_unauthorized_attempt'] = 'erfolglos versucht, eine Seite, die die folgende Berechtigung "% s" benötigt von Access';
$lang['bf_keyboard_shortcuts'] = 'Verfügbare Tastaturkürzel:';
$lang['bf_keyboard_shortcuts_none'] = 'Es ist kein Kürzel definiert';
$lang['bf_keyboard_shortcuts_edit'] = 'Tastaturkürzel editiert';

//--------------------------------------------------------------------
// Common
//--------------------------------------------------------------------
$lang['bf_question_mark'] = '?';
$lang['bf_language_direction'] = 'ltr';
$lang['log_intro'] = 'Dies sind Ihre Lognachrichten';

//--------------------------------------------------------------------
// Login
//--------------------------------------------------------------------

$lang['bf_action_register'] = 'Sign Up';
$lang['bf_forgot_password'] = 'Paßwort vergessen?';
$lang['bf_remember_me'] = 'Remember me';

//--------------------------------------------------------------------
// Password Help Fields to be used as a warning on register
//--------------------------------------------------------------------

$lang['bf_password_number_required_help'] = ' Das Passwort muss mindestens 1 Zeichen enthalten.';
$lang['bf_password_caps_required_help'] = ' Das Passwort muss mindestens 1 großgeschriebenes Zeichen enthalten.';
$lang['bf_password_symbols_required_help'] = ' Das Passwort muss mindestens 1 Symbol enthalten.';
$lang['bf_password_min_length_help'] = ' Das Passwort muss mindestens %s Zeichen lang sein.';
$lang['bf_password_length'] = 'Paßwortlänge';

//--------------------------------------------------------------------
// User Meta examples
//--------------------------------------------------------------------

$lang['user_meta_street_name'] = 'Straßenname';
$lang['user_meta_type'] = 'Type';
$lang['user_meta_country'] = 'Land';
$lang['user_meta_state'] = 'Staat';

//--------------------------------------------------------------------
// Activation
//--------------------------------------------------------------------

$lang['bf_activate_method'] = 'Aktivierungsmethode';
$lang['bf_activate_none'] = 'Nichts';
$lang['bf_activate_email'] = 'E-Mail';
$lang['bf_activate_admin'] = 'Admin';
$lang['bf_activate'] = 'Aktivieren';
$lang['bf_activate_resend'] = 'Aktivierung erneut senden';
$lang['bf_reg_complete_error'] = 'Ein Fehler ist aufgetreten bei dem Abschluss Ihrer Registrierung aufgetreten. Bitte versuchen Sie es noch einmal oder kontaktieren Sie den Website-Administrator.';
$lang['bf_reg_activate_email'] = 'Eine E-Mail mit Ihrem Aktivierungscode wurde an [EMAIL] gesendet.';
$lang['bf_reg_activate_admin'] = 'Sie werden benachrichtigt, wenn der Website-Administrator Ihre Mitgliedschaft geprüft hat.';
$lang['bf_reg_activate_none'] = 'Bitte loggen Sie sich ein um diese Seite zu benutzen';
$lang['bf_user_not_active'] = 'Benutzeraccount ist nicht aktiv';
$lang['bf_login_activate_title'] = 'Müssen Sie Ihr Konto aktivieren?';
$lang['bf_login_activate_email'] = '<b> Haben sie den Aktivierungs-Code eingeben, um Ihre Mitgliedschaft zu aktivieren?</b> Geben Sie Ihn bitte auf dieser Seite [ACCOUNT_ACTIVATE_URL] erneut ein.<br /><br />    <b>Bracuchen Sie einen neuen Code?</b> Fordern Sie Ihn bitte auf dieser Seite [ACTIVATE_RESEND_URL] erneut an.';
