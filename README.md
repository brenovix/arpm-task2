## Task 2 - Eloquent

Refactored OrderController to improve both performance and readability.

- Created OrderService class to handle Models calls.
- Splitted the code in different methods, improving readibility and maintanance.
- Refactored Model calls to avoid unecessary requests.
- Removed unecessary loops, replacing for built-in array_* functions
- Refactored OrderController class to let it only handle requests and responses.

## Tips for future improvements
- Repository pattern: Refactor the code to adhere to Repository pattern. This way will be possible to decouple Model and handle complex and more performatic queries.
- ADR pattern: Refactor the code to adhere to Action-Domain-Responder pattern. It will remove the needing of work with Controllers. Thus, any maintance will be easier, since the code will not contain such mix of layers.  