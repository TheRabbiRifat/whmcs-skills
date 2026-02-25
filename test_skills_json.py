import json
import os

def test_distributed_skills():
    # 1. Test API Skills
    api_dir = 'api-reference'
    api_json_files = [f for f in os.listdir(api_dir) if f.endswith('.json')]

    assert len(api_json_files) > 0, "No API JSON files found"

    for filename in api_json_files:
        filepath = os.path.join(api_dir, filename)
        with open(filepath, 'r') as f:
            data = json.load(f)

        assert isinstance(data, dict), f"{filename}: Root element should be a dict"
        assert 'type' in data, f"{filename}: Missing 'type'"
        assert data['type'] == 'api_command', f"{filename}: Invalid type"
        assert 'name' in data, f"{filename}: Missing 'name'"
        # Description might be empty if not found, but key should exist
        assert 'description' in data, f"{filename}: Missing 'description'"
        assert 'parameters' in data, f"{filename}: Missing 'parameters'"

    # 2. Test Hook Skills
    hooks_dir = 'hooks-reference'
    hooks_json_files = [f for f in os.listdir(hooks_dir) if f.endswith('.json')]

    assert len(hooks_json_files) > 0, "No Hook JSON files found"

    for filename in hooks_json_files:
        filepath = os.path.join(hooks_dir, filename)
        with open(filepath, 'r') as f:
            data = json.load(f)

        assert isinstance(data, list), f"{filename}: Root element should be a list"

        for item in data:
            assert isinstance(item, dict), f"{filename}: Item should be a dict"
            assert 'type' in item, f"{filename}: Item missing 'type'"
            assert item['type'] == 'hook', f"{filename}: Item invalid type"
            assert 'name' in item, f"{filename}: Item missing 'name'"

    # 3. Test Master Index
    assert os.path.exists('skills.md'), "skills.md does not exist"
    with open('skills.md', 'r') as f:
        content = f.read()

    assert "# WHMCS AI Agent Skills Index" in content
    assert "## API Commands" in content
    assert "## Hooks" in content
    # Check for at least one link
    assert "](" in content, "No links found in skills.md"

    print(f"Validation passed! API Files: {len(api_json_files)}, Hook Files: {len(hooks_json_files)}")

if __name__ == "__main__":
    test_distributed_skills()
