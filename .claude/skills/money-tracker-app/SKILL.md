```markdown
# money-tracker-app Development Patterns

> Auto-generated skill from repository analysis

## Overview
This skill covers the development patterns and conventions used in the `money-tracker-app` repository, a TypeScript codebase for tracking financial transactions. It documents file naming, import/export styles, commit message patterns, and testing approaches. Use this as a reference for contributing code that aligns with the project's established practices.

## Coding Conventions

### File Naming
- Use **camelCase** for file names.
  - Example: `transactionList.ts`, `userProfile.ts`

### Import Style
- Use **relative imports** for modules within the project.
  - Example:
    ```typescript
    import { calculateBalance } from './utils';
    import { Transaction } from '../models/transaction';
    ```

### Export Style
- Use **named exports** for all modules.
  - Example:
    ```typescript
    // In utils.ts
    export function calculateBalance(transactions: Transaction[]) { ... }
    ```

### Commit Messages
- Commit messages are **freeform** (no enforced structure).
- Prefixes may be used but are not required.
- Average commit message length: ~46 characters.
  - Example:  
    ```
    Add support for recurring transactions
    ```

## Workflows

### Adding a New Feature
**Trigger:** When implementing a new feature or module  
**Command:** `/add-feature`

1. Create a new file using camelCase naming.
2. Implement the feature using TypeScript.
3. Use relative imports to include dependencies.
4. Export functions or components using named exports.
5. Write corresponding tests in a `.test.ts` file.
6. Commit with a clear, descriptive message.

### Writing and Running Tests
**Trigger:** When adding or updating tests  
**Command:** `/run-tests`

1. Create or update test files matching the pattern `*.test.*`.
2. Use the project's preferred (unknown) testing framework.
3. Run the test suite using the project's test command (see project README or package.json).
4. Ensure all tests pass before committing.

### Refactoring Code
**Trigger:** When improving code structure without changing functionality  
**Command:** `/refactor`

1. Update file and variable names to follow camelCase.
2. Ensure all imports are relative.
3. Use named exports consistently.
4. Update or add tests if necessary.
5. Commit with a message describing the refactor.

## Testing Patterns

- Test files follow the pattern: `*.test.*` (e.g., `transactionList.test.ts`).
- The testing framework is not specified; check the project documentation for details.
- Place tests alongside the code or in a dedicated test directory as per project structure.

**Example:**
```typescript
// transactionList.test.ts
import { calculateBalance } from './transactionList';

test('calculates balance correctly', () => {
  // test implementation
});
```

## Commands
| Command       | Purpose                                   |
|---------------|-------------------------------------------|
| /add-feature  | Scaffold and implement a new feature      |
| /run-tests    | Run all tests in the codebase             |
| /refactor     | Refactor code to match conventions        |
```
