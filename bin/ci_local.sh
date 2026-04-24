#!/bin/bash
# Description: Runs all local CI checks.

echo "🔍 Starting local CI checks..."

# Run tests
./bin/run_tests.sh
RUN_TESTS_EXIT_CODE=$?

if [ $RUN_TESTS_EXIT_CODE -eq 0 ]; then
    echo "✨ All checks passed!"
else
    echo "❌ Some checks failed (Exit code: $RUN_TESTS_EXIT_CODE)."
    exit 1
fi
