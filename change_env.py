import os.path
import re
import subprocess
import sys

def main():
    cur = get_current_environment()
    new = sys.argv[1]

    if not environment_exists(new):
        print("ERROR: `{}` environment file does not exist (create docker-compose-{}.yaml)".format(new, new))
        sys.exit(1)
    
    if not env_file_exists(new):
        print("ERROR: `{}` env file (.env-{}) does not exist".format(new, new))
        sys.exit(1)

    print("Changing environment from {} to {}".format(cur, new))
    change_environment(new)

def get_current_environment():
    result = subprocess.run(
        ['ls', '-l', './docker-compose.override.yml'],
        stdout=subprocess.PIPE
    )

    env_regex = re.compile(br"docker-compose.override.yml -> docker-compose-(.*)\.yml$")
    match = env_regex.search(result.stdout)

    return match.group(1).decode() if match else ''

def change_environment(new):
    if(environment_exists(new)):
        # Remove and replace the docker-compose.override symlink
        override_file = 'docker-compose-{}.yml'.format(new)

        subprocess.run(['rm', 'docker-compose.override.yml'], check=False)

        subprocess.run(
            ['ln', '-s', override_file, 'docker-compose.override.yml'],
            check=True
        )

        # Remove and replace the .env symlink
        subprocess.run(['rm', '.env'], check=False)
        subprocess.run(['ln', '-s', '.env-{}'.format(new), '.env'], check=True)

def environment_exists(env_name):
    return os.path.exists('docker-compose-{}.yml'.format(env_name))

def env_file_exists(env_name):
    return os.path.exists('.env-{}'.format(env_name))

if __name__ == '__main__':
    main()
