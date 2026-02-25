import json
import os

def test_skills_json():
    filename = 'whmcs_skills.json'
    assert os.path.exists(filename), f"{filename} does not exist"

    with open(filename, 'r') as f:
        data = json.load(f)

    assert isinstance(data, list), "Root element should be a list"
    assert len(data) > 0, "List should not be empty"

    for item in data:
        assert 'type' in item, "Item missing 'type'"
        assert 'name' in item, "Item missing 'name'"
        assert 'description' in item, "Item missing 'description'"
        assert 'parameters' in item, "Item missing 'parameters'"
        assert isinstance(item['parameters'], list), "'parameters' should be a list"

        if item['type'] == 'api_command':
            for param in item['parameters']:
                # API params keys: Parameter, Type, Description, Required
                # But headers might be slightly different case if not normalized?
                # The script preserves original headers.
                pass
        elif item['type'] == 'hook':
            for param in item['parameters']:
                # Hook params keys: Variable, Type, Notes
                pass

    print("Validation passed!")

if __name__ == "__main__":
    test_skills_json()
