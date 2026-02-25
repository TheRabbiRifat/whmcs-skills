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

if __name__ == "__main__":
    unittest.main()
