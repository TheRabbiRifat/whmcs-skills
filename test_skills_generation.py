import unittest
import json
import os

class TestSkillsGeneration(unittest.TestCase):
    def test_provisioning_skills(self):
        file_path = "skills/provisioning_modules.json"
        self.assertTrue(os.path.exists(file_path), "Provisioning skills file not found")

        with open(file_path, "r") as f:
            data = json.load(f)

        self.assertEqual(data.get("module_type"), "provisioning")
        self.assertTrue(len(data.get("common_parameters")) > 0, "Common parameters should not be empty")
        self.assertTrue(len(data.get("functions")) > 0, "Functions list should not be empty")

        # check specific function
        create_account = next((f for f in data["functions"] if f["name"] == "CreateAccount"), None)
        self.assertIsNotNone(create_account, "CreateAccount function not found")
        self.assertIn("$params", create_account["arguments"])

    def test_addon_skills(self):
        file_path = "skills/addon_modules.json"
        self.assertTrue(os.path.exists(file_path), "Addon skills file not found")

        with open(file_path, "r") as f:
            data = json.load(f)

        self.assertEqual(data.get("module_type"), "addon")
        self.assertTrue(len(data.get("functions")) > 0, "Functions list should not be empty")

        config = next((f for f in data["functions"] if f["name"] == "Config"), None)
        self.assertIsNotNone(config, "Config function not found")

    def test_payment_skills(self):
        file_path = "skills/payment_gateways.json"
        self.assertTrue(os.path.exists(file_path), "Payment gateway skills file not found")

        with open(file_path, "r") as f:
            data = json.load(f)

        self.assertEqual(data.get("module_type"), "payment_gateway")
        self.assertTrue(len(data.get("functions")) > 0, "Functions list should not be empty")

    def test_registrar_skills(self):
        file_path = "skills/registrar_modules.json"
        self.assertTrue(os.path.exists(file_path), "Registrar skills file not found")

        with open(file_path, "r") as f:
            data = json.load(f)

        self.assertEqual(data.get("module_type"), "registrar")
        self.assertTrue(len(data.get("common_parameters")) > 0, "Common parameters should not be empty")
        self.assertTrue(len(data.get("functions")) > 0, "Functions list should not be empty")

        register_domain = next((f for f in data["functions"] if f["name"] == "RegisterDomain"), None)
        self.assertIsNotNone(register_domain, "RegisterDomain function not found")

    def test_hook_skills(self):
        file_path = "skills/hooks.json"
        self.assertTrue(os.path.exists(file_path), "Hooks skills file not found")

        with open(file_path, "r") as f:
            data = json.load(f)

        self.assertEqual(data.get("type"), "hooks")
        self.assertTrue(len(data.get("hooks")) > 0, "Hooks list should not be empty")

        client_add = next((h for h in data["hooks"] if h["name"] == "ClientAdd"), None)
        self.assertIsNotNone(client_add, "ClientAdd hook not found")

    def test_api_skills(self):
        file_path = "skills/api.json"
        self.assertTrue(os.path.exists(file_path), "API skills file not found")

        with open(file_path, "r") as f:
            data = json.load(f)

        self.assertEqual(data.get("type"), "api")
        self.assertTrue(len(data.get("functions")) > 0, "API Functions list should not be empty")

        add_client = next((f for f in data["functions"] if f["command"] == "AddClient"), None)
        self.assertIsNotNone(add_client, "AddClient command not found")
        self.assertTrue(len(add_client["parameters"]) > 0, "AddClient parameters should not be empty")

    def test_theme_skills(self):
        file_path = "skills/themes.json"
        self.assertTrue(os.path.exists(file_path), "Theme skills file not found")
        with open(file_path, "r") as f:
            data = json.load(f)
        self.assertEqual(data.get("category"), "themes")
        self.assertTrue(len(data.get("topics")) > 0, "Topics should not be empty")

    def test_mail_provider_skills(self):
        file_path = "skills/mail_providers.json"
        self.assertTrue(os.path.exists(file_path), "Mail Provider skills file not found")
        with open(file_path, "r") as f:
            data = json.load(f)
        self.assertEqual(data.get("category"), "mail-providers")

    def test_notification_provider_skills(self):
        file_path = "skills/notification_providers.json"
        self.assertTrue(os.path.exists(file_path), "Notification Provider skills file not found")
        with open(file_path, "r") as f:
            data = json.load(f)
        self.assertEqual(data.get("category"), "notification-providers")

    def test_advanced_skills(self):
        file_path = "skills/advanced.json"
        self.assertTrue(os.path.exists(file_path), "Advanced skills file not found")
        with open(file_path, "r") as f:
            data = json.load(f)
        self.assertEqual(data.get("category"), "advanced")

    def test_oauth_skills(self):
        file_path = "skills/oauth.json"
        self.assertTrue(os.path.exists(file_path), "OAuth skills file not found")
        with open(file_path, "r") as f:
            data = json.load(f)
        self.assertEqual(data.get("category"), "oauth")

    def test_language_skills(self):
        file_path = "skills/languages.json"
        self.assertTrue(os.path.exists(file_path), "Language skills file not found")
        with open(file_path, "r") as f:
            data = json.load(f)
        self.assertEqual(data.get("category"), "languages")

    def test_index_exists(self):
        self.assertTrue(os.path.exists("skills/skills.md"), "skills.md index file not found")

    def test_manifest_skills(self):
        file_path = "skills/manifest.json"
        self.assertTrue(os.path.exists(file_path), "Manifest skills file not found")
        with open(file_path, "r") as f:
            data = json.load(f)
        self.assertEqual(data.get("role"), "WHMCS Expert Developer")
        self.assertTrue(len(data.get("skills")) > 0, "Skills list should not be empty")

    def test_skill_md_exists(self):
        self.assertTrue(os.path.exists("skills/SKILL.md"), "SKILL.md file not found")

if __name__ == "__main__":
    unittest.main()
